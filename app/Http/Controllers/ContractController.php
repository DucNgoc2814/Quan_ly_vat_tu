<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\ContractDetail;
use App\Models\Variation;
use Exception;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Dompdf\Options;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Writer\HTML;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.contract.';

    public function index()
    {
        $contracts = Contract::with('contractStatus')->latest('id')->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variation = Variation::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('variation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        // dd($request->all());
        try {
            $contractNumber = 'HDB' . str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
            // 1. Tạo hợp đồng mới với trạng thái mặc định là 1 (đang chờ)
            $contract = Contract::create([
                'contract_status_id' => 1,
                'contract_name' => $contractNumber,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                "timestart" => $request->timestart,
                "timeend" => $request->timeend,
                'file' => null
            ]);

            // 2. Lưu chi tiết các sản phẩm trong hợp đồng
            $variations = $request->variation_id ?? [];
            $quantities = $request->quantity ?? [];

            if (!empty($variations) && count($variations) > 0) {
                foreach ($variations as $key => $variation_id) {
                    if ($variation_id != 0 && isset($quantities[$key]) && $quantities[$key] > 0) {
                        $prices = $request->price ?? [];
                        ContractDetail::create([
                            'contract_id' => $contract->id,
                            'variation_id' => $variation_id,
                            'quantity' => $quantities[$key],
                            "price" => $prices[$key],
                        ]);
                    }
                }
            }

            // 3. Tạo file Word từ thông tin hợp đồng và chi tiết hợp đồng
            $files = $this->exportContractToWord($contract, $request);
            $contract->update([
                'file' => $files['docx'],
                'file_pdf' => $files['pdf']
            ]);

            // 4. Trở về trang danh sách hợp đồng
            return redirect()
                ->route('contract.index')
                ->with('success', 'Tạo hợp đồng thành công!');
        } catch (Exception $e) {
            // dd($request->all());
            return back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function exportContractToWord($contract, $request)
    {
        $templatePath = storage_path('app/public/templates/hop-dong.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        // Replace basic information
        $templateProcessor->setValue('contract_name', $contract->contract_name);
        $templateProcessor->setValue('customer_name', $contract->customer_name);
        $templateProcessor->setValue('customer_phone', $contract->customer_phone);
        $templateProcessor->setValue('customer_email', $contract->customer_email);

        // Prepare table data
        $variations = $request->variation_id ?? [];
        $quantities = $request->quantity ?? [];
        $prices = $request->price ?? [];

        $tableData = [];
        $totalAmount = 0;

        foreach ($variations as $key => $variationID) {
            if ($variationID != 0 && isset($quantities[$key])) {
                $variation = Variation::find($variationID);
                $quantity = $quantities[$key];
                $price = $prices[$key];
                $subtotal = $quantity * $price;
                $totalAmount += $subtotal;

                $tableData[] = [
                    'stt' => $key + 1,
                    'product_name' => $variation->name ?? 'N/A',
                    'quantity' => number_format($quantity),
                    'price' => number_format($price) . ' VNĐ',
                    'subtotal' => number_format($subtotal) . ' VNĐ'
                ];
            }
        }

        // Add data to table
        $templateProcessor->cloneRowAndSetValues('stt', $tableData);

        // Add total amount and time
        $templateProcessor->setValue('total_amount', number_format($totalAmount) . ' VNĐ');
        $templateProcessor->setValue('timestart', date('d/m/Y', strtotime($contract->timestart)));
        $templateProcessor->setValue('timeend', date('d/m/Y', strtotime($contract->timeend)));

        $docxFileName = 'Hopdong_' . $contract->id . '.docx';
        $docxFilePath = storage_path('app/public/contracts/' . $docxFileName);
        $templateProcessor->saveAs($docxFilePath);

        // Configure DomPDF with Vietnamese font support
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        Settings::setPdfRendererPath($domPdfPath);
        Settings::setPdfRendererName('DomPDF');

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        // Thêm style để sử dụng font DejaVu Sans
        $html = '<style>
            body { font-family: "DejaVu Sans", sans-serif; }
            * { font-family: "DejaVu Sans", sans-serif !important; }
        </style>';
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';

        // Load file docx và chuyển sang HTML
        $phpWord = IOFactory::load($docxFilePath);
        $htmlWriter = new HTML($phpWord);
        $html .= $htmlWriter->getContent();

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->render();

        $pdfFileName = 'Hopdong_' . $contract->id . '.pdf';
        $pdfFilePath = storage_path('app/public/contracts/' . $pdfFileName);
        file_put_contents($pdfFilePath, $dompdf->output());

        return [
            'docx' => 'contracts/' . $docxFileName,
            'pdf' => 'contracts/' . $pdfFileName
        ];
    }



    public function sendToManager($id)
    {
        try {
            $contract = Contract::findOrFail($id);

            // Cập nhật trạng thái hợp đồng thành "Đang chờ xác nhận" (giả sử là status_id = 2)
            $contract->update([
                'contract_status_id' => 4
            ]);

            return redirect()->back()->with('success', 'Đã gửi hợp đồng cho quản lý xác nhận');
        } catch (Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function sendToManagerPdf($id)
    {
        $contract = Contract::findOrFail($id);
        session()->push('pending_contract_pdfs', [
            'contract' => $contract,
            'timestamp' => now()->timestamp
        ]);

        return redirect()->route('contract.index')
            ->with('success', 'Đã gửi hợp đồng cho giám đốc thành công');
    }
    public function confirmContract($id)
    {
        try {
            $contract = Contract::findOrFail($id);
            $contract->update([
                'contract_status_id' => 2
            ]);
            return redirect()->back()->with('success', 'Đã xác nhận hợp đồng');
        } catch (Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function rejectContract($id)
    {
        try {
            $contract = Contract::findOrFail($id);
            $contract->update([
                'contract_status_id' => 3
            ]);
            return redirect()->back()->with('success', 'Đã từ chối hợp đồng');
        } catch (Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function sendToCustomer($id)
    {
        $contract = Contract::findOrFail($id);
        $pdfFileName = 'Hopdong_' . $contract->id . '.pdf';
        $wordFileName = 'Hopdong_' . $contract->id . '.docx';

        $pdfFilePath = storage_path('app/public/contracts/' . $pdfFileName);
        $wordFilePath = storage_path('app/public/contracts/' . $wordFileName);

        $token = Str::random(60);
        $contract->verification_token = $token;
        $contract->save();

        $baseUrl = config('app.url');

        Mail::send('emails.contract', [
            'contract' => $contract,
            'token' => $token,
            'baseUrl' => $baseUrl
        ], function ($message) use ($contract, $pdfFilePath, $wordFilePath) {
            $message->to($contract->customer_email)
                ->subject('Hợp đồng của bạn')
                ->attach($pdfFilePath, [
                    'as' => 'Hopdong_' . $contract->id . '.pdf',
                    'mime' => 'application/pdf'
                ])
                ->attach($wordFilePath, [
                    'as' => 'Hopdong_' . $contract->id . '.docx',
                    'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ]);
        });

        $contract->contract_status_id = 5;
        $contract->save();

        return redirect()->back()->with('success', 'Đã gửi hợp đồng cho khách hàng thành công');
    }
    public function customerApprove($id)
    {
        $contract = Contract::findOrFail($id)->where('verification_token', request('token'))
            ->firstOrFail();
        $contract = Contract::findOrFail($id)->where('verification_token', request('token'))
            ->firstOrFail();
        if ($contract->contract_status_id == 6 || $contract->contract_status_id == 7) {
            return view('emails.processed', ['message' => 'Hợp đồng này đã được xử lý trước đó']);
        }
        $contract->contract_status_id = 6;
        $contract->save();

        return view('emails.success', ['message' => 'Xác nhận hợp đồng thành công']);
    }
    public function customerReject($id)
    {
        $contract = Contract::findOrFail($id);
        if ($contract->contract_status_id == 6 || $contract->contract_status_id == 7) {
            return view('emails.processed', ['message' => 'Hợp đồng này đã được xử lý trước đó']);
        }
        $contract->contract_status_id = 7;
        $contract->save();

        return view('emails.fail', ['message' => 'Hủy hợp đồng thành công']);
    }
    public function showPdf($id)
    {
        $contract = Contract::findOrFail($id);
        $pdfPath = public_path("storage/contracts/Hopdong_{$id}.pdf");
        return response()->file($pdfPath);
    }


    /**
     * Display the specified resource.
     */

    /**
     * Display the specified resource.
     */
    public function show(Contract $brand)
    {
        //
    }

    public function edit(Contract $contract_number)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $data = $request->validated();
        $filePath = null;

        try {
            if ($request->hasFile('file')) {
                if ($contract->file && Storage::disk('public')->exists($contract->file)) {
                    Storage::disk('public')->delete($contract->file);
                }
                $filePath = $request->file('file')->store('contracts', 'public');
            }
            $contract->update([
                'contract_number' => $data['contract_number'],
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'number_phone' => $data['number_phone'],
                'total_amount' => $data['total_amount'],
                'note' => $data['note'],
                'file' => $filePath ? $filePath : $contract->file,
            ]);

            return redirect()
                ->route('contract.index')
                ->with('success', 'Cập nhật hợp đồng thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
