<?php

namespace App\Http\Controllers;

use App\Events\NewContractCreated;
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
use Illuminate\Http\Request;
use App\Events\ContractRejected;
use App\Events\ContractSentToCustomer;
use App\Events\ContractStatusUpdated;
use App\Models\Contract_status_time;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Payment;
use App\Models\Payment_history;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.contract.';

    public function index()
    {
        $token = Session::get('token');
        $payload = JWTAuth::setToken($token)->getPayload();
        $role = $payload->get('role');
        $userId = $payload->get('id');

        $query = Contract::with('contractStatus');

        // Filter for non-admin users
        if ($role != '1') {
            $query->where('employee_id', $userId);
        }

        $contracts = $query->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variation = Variation::all();
        $customers  = Customer::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('variation', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        // dd($request->all());

        try {
            $contractNumber = 'HDB' . str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
            $total = 0;
            for ($i = 0; $i < count($request->quantity); $i++) {
                $total += $request->quantity[$i] * $request->price[$i]; // Tính tổng
            }
            // 1. Tạo hợp đồng mới với trạng thái mặc định là 1 (đang chờ)
            $contract = Contract::create([
                'contract_status_id' => 1,
                'employee_id' => JWTAuth::setToken(Session::get('token'))->getPayload()->get('id'),
                'customer_id' => $request->customer_id,
                'contract_number' => $contractNumber,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'total_amount' => $total,
                "timestart" => $request->timestart,
                "timeend" => $request->timeend,
                'file' => null
            ]);
            Contract_status_time::create([
                'contract_id' => $contract->id,
                'contract_status_id' => 1
            ]);

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
                            'remaining_quantity' => $quantities[$key],
                            "price" => $prices[$key],
                        ]);
                    }
                }
            }

            $files = $this->exportContractToWord($contract, $request);
            $contract->update([
                'file' => $files['docx'],
                'file_pdf' => $files['pdf']
            ]);

            event(new NewContractCreated($contract));
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
        $templateProcessor->setValue('contract_number', $contract->contract_number);
        $templateProcessor->setValue('customer_name', $contract->customer_name);
        $templateProcessor->setValue('customer_phone', $contract->customer_phone);
        $templateProcessor->setValue('customer_email', $contract->customer_email);
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

        $templateProcessor->cloneRowAndSetValues('stt', $tableData);
        $templateProcessor->setValue('total_amount', number_format($totalAmount) . ' VNĐ');
        $templateProcessor->setValue('timestart', date('d/m/Y', strtotime($contract->timestart)));
        $templateProcessor->setValue('timeend', date('d/m/Y', strtotime($contract->timeend)));
        $templateProcessor->setValue('time', date('d/m/Y', strtotime($contract->created_at)));

        $docxFileName = 'Hopdong_' . $contract->id . '.docx';
        $docxFilePath = storage_path('app/public/contracts/' . $docxFileName);
        $templateProcessor->saveAs($docxFilePath);
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        Settings::setPdfRendererPath($domPdfPath);
        Settings::setPdfRendererName('DomPDF');

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        $html = '<style>
            body { font-family: "DejaVu Sans", sans-serif; }
            * { font-family: "DejaVu Sans", sans-serif !important; }
        </style>';
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';

        $phpWord = IOFactory::load($docxFilePath);
        $htmlWriter = new HTML($phpWord);
        $html .= $htmlWriter->getContent();

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->render();

        $pdfFileName = 'Hopdong_' . $contract->id . '.pdf';
        $pdfFilePath = storage_path('app/public/contracts/' . $pdfFileName);
        file_put_contents($pdfFilePath, $dompdf->output());

        event(new ContractStatusUpdated($contract));

        return [
            'docx' => 'contracts/' . $docxFileName,
            'pdf' => 'contracts/' . $pdfFileName
        ];
    }



    public function sendToManager($id)
    {
        try {
            $contract = Contract::findOrFail($id);
            $contract->update([
                'contract_status_id' => 4
            ]);
            Contract_status_time::create([
                'contract_id' => $contract->id,
                'contract_status_id' => 4
            ]);
            event(new ContractStatusUpdated($contract));

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
        event(new ContractStatusUpdated($contract));

        return redirect()->route('contract.index')
            ->with('success', 'Đã gửi hợp đồng cho giám đốc thành công');
    }

    public function confirmContract($id)
    {
        try {
            $contract = Contract::findOrFail($id);

            // Xử lý file Word
            $wordPath = storage_path('app/public/contracts/Hopdong_' . $id . '.docx');
            $templateProcessor = new TemplateProcessor($wordPath);
            $signaturePath = storage_path('app/public/signatures/signatures.png');
            $templateProcessor->setImageValue('signaturee', $signaturePath);
            $templateProcessor->saveAs($wordPath);

            // Tạo lại file PDF từ file Word đã cập nhật
            $domPdfPath = base_path('vendor/dompdf/dompdf');
            Settings::setPdfRendererPath($domPdfPath);
            Settings::setPdfRendererName('DomPDF');

            $phpWord = IOFactory::load($wordPath);
            $htmlWriter = new HTML($phpWord);
            $html = $htmlWriter->getContent();

            $options = new Options();
            $options->set('defaultFont', 'DejaVu Sans');
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->render();

            $pdfPath = storage_path('app/public/contracts/Hopdong_' . $id . '.pdf');
            file_put_contents($pdfPath, $dompdf->output());

            // Cập nhật trạng thái
            $contract->contract_status_id = 2;
            Contract_status_time::create([
                'contract_id' => $contract->id,
                'contract_status_id' => 2
            ]);
            $contract->save();
            event(new ContractStatusUpdated($contract));

            return redirect()->back()->with('success', 'Đã xác nhận hợp đồng');
        } catch (Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    public function rejectContract(Request $request, $id)
    {
        $contract = Contract::find($id);
        $contract->contract_status_id = 3;
        Contract_status_time::create([
            'contract_id' => $contract->id,
            'contract_status_id' => 3
        ]);
        $contract->reject_reason = $request->reason;
        $contract->save();
        event(new ContractStatusUpdated($contract));

        return response()->json([
            'success' => true,
            'message' => 'Hợp đồng không được xác nhận'
        ]);
    }

    public function sendToCustomer($id)
    {
        try {
            $contract = Contract::findOrFail($id);

            // Kiểm tra trạng thái hợp đồng
            if ($contract->contract_status_id != 2) {
                return redirect()->back()->with('error', 'Chỉ có thể gửi hợp đồng cho khách hàng sau khi giám đốc đã xác nhận');
            }

            // Kiểm tra email khách hàng
            if (empty($contract->customer_email)) {
                return redirect()->back()->with('error', 'Không tìm thấy email khách hàng');
            }

            $pdfFileName = 'Hopdong_' . $contract->id . '.pdf';
            $wordFileName = 'Hopdong_' . $contract->id . '.docx';

            $pdfFilePath = storage_path('app/public/contracts/' . $pdfFileName);
            $wordFilePath = storage_path('app/public/contracts/' . $wordFileName);

            // Kiểm tra file tồn tại
            if (!file_exists($pdfFilePath) || !file_exists($wordFilePath)) {
                return redirect()->back()->with('error', 'Không tìm thấy file hợp đồng');
            }

            $token = Str::random(60);
            $contract->verification_token = $token;
            $contract->save();

            $baseUrl = config('app.url');

            try {
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
                Contract_status_time::create([
                    'contract_id' => $contract->id,
                    'contract_status_id' => 5
                ]);
                $contract->save();

                event(new ContractStatusUpdated($contract));

                return redirect()->back()->with('success', 'Đã gửi hợp đồng cho khách hàng thành công');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi khi gửi email: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
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

        $wordPath = storage_path('app/public/contracts/Hopdong_' . $id . '.docx');
        $templateProcessor = new TemplateProcessor($wordPath);
        $signaturePath = storage_path('app/public/signatures/signatures(1).png');
        $templateProcessor->setImageValue('signature', $signaturePath);
        $templateProcessor->saveAs($wordPath);

        $domPdfPath = base_path('vendor/dompdf/dompdf');
        Settings::setPdfRendererPath($domPdfPath);
        Settings::setPdfRendererName('DomPDF');

        $phpWord = IOFactory::load($wordPath);
        $htmlWriter = new HTML($phpWord);
        $html = $htmlWriter->getContent();

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->render();

        $pdfPath = storage_path('app/public/contracts/Hopdong_' . $id . '.pdf');
        file_put_contents($pdfPath, $dompdf->output());

        $contract->contract_status_id = 6;
        Contract_status_time::create([
            'contract_id' => $contract->id,
            'contract_status_id' => 6
        ]);
        $contract->save();

        Mail::send('emails.contract_approved', [
            'contract' => $contract
        ], function ($message) use ($contract, $pdfPath) {
            $message->to($contract->customer_email)
                ->subject('Xác nhận hợp đồng thành công')
                ->attach($pdfPath, [
                    'as' => 'Hopdong_' . $contract->id . '.pdf',
                    'mime' => 'application/pdf'
                ]);
        });
        event(new ContractStatusUpdated($contract));

        return view('emails.success', ['message' => 'Xác nhận hợp đồng thành công']);
    }
    public function customerReject($id)
    {
        $contract = Contract::findOrFail($id);
        if ($contract->contract_status_id == 6 || $contract->contract_status_id == 7) {
            return view('emails.processed', ['message' => 'Hợp đồng này đã được xử lý trước đó']);
        }
        $contract->contract_status_id = 7;
        Contract_status_time::create([
            'contract_id' => $contract->id,
            'contract_status_id' => 7
        ]);
        $contract->save();

        Mail::send('emails.contract_rejected', [
            'contract' => $contract
        ], function ($message) use ($contract) {
            $message->to($contract->customer_email)
                ->subject('Xác nhận từ chối hợp đồng');
        });


        event(new ContractStatusUpdated($contract));

        return view('emails.fail', ['message' => 'Hủy hợp đồng thành công']);
    }
    public function showPdf($id)
    {
        $contract = Contract::findOrFail($id);
        $pdfPath = public_path("storage/contracts/Hopdong_{$id}.pdf");
        return response()->file($pdfPath);
    }

    public function getStatusHistory($id)
    {
        $statusHistory = Contract_status_time::with('contractStatus')
            ->where('contract_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($statusHistory);
    }


    // public function showWord($id)
    // {
    //     $contract = Contract::findOrFail($id);
    //     $wordUrl = Storage::url("contracts/Hopdong_{$id}.docx");
    //     $fullUrl = asset($wordUrl);
    //     return response()->json(['url' => $fullUrl]);
    // }

    public function show($id)
    {
        $contract = Contract::with(['contractDetails', 'orders'])->findOrFail($id);
        $employees = Employee::where('role_id', '!=', '1')
            ->where('is_active', 1)
            ->select('id', 'name')
            ->get();
        // Tính tổng tiền đã thanh toán
        $totalPaid = Payment_history::where('related_id', $id)
            ->where('transaction_type', 'contract')
            ->sum('amount');

        // Tính phần trăm thanh toán
        $percentagePaid = $contract->total_amount > 0 ?
            ($totalPaid / $contract->total_amount * 100) : 0;

        // Kiểm tra trạng thái giao hàng
        $deliveryStatus = [];
        $totalDelivered = 0;
        $totalQuantity = 0;

        foreach ($contract->contractDetails as $detail) {
            $totalQuantity += $detail->quantity;
            $delivered = $detail->quantity - $detail->remaining_quantity;
            $totalDelivered += $delivered;

            $deliveryStatus[] = [
                'product' => $detail->variation->name,
                'total' => $detail->quantity,
                'delivered' => $delivered,
                'remaining' => $detail->remaining_quantity
            ];
        }

        $percentageDelivered = $totalQuantity > 0 ?
            ($totalDelivered / $totalQuantity * 100) : 0;

        $payments = Payment::pluck('name', 'id');
        $paymentHistories = Payment_history::where('related_id', $id)
            ->where('transaction_type', 'contract')
            ->get();

        // Thêm biến kiểm tra điều kiện tạo đơn hàng và thanh toán
        $canCreateOrderAndPayment = $contract->contract_status_id == 6;

        // Thêm mảng thông báo trạng thái
        $statusMessages = [
            1 => 'Hợp đồng chưa được gửi cho giám đốc',
            2 => 'Hợp đồng chưa được gửi cho khách hàng',
            3 => 'Hợp đồng đã bị hủy',
            4 => 'Hợp đồng đang chờ giám đốc xác nhận',
            5 => 'Đang chờ khách hàng xác nhận',
            7 => 'Khách hàng không ồng  với hợp đồng',
            8 => 'Hợp đồng đã hoàn thành',
            9 => 'Hợp đồng đã quá hạn'
        ];

        // Kiểm tra và cập nhật trạng thái nếu cần
        $this->checkAndUpdateContractStatus($contract);

        return view('admin.components.contract.detail', compact(
            'contract',
            'totalPaid',
            'percentagePaid',
            'deliveryStatus',
            'percentageDelivered',
            'paymentHistories',
            'payments',
            'canCreateOrderAndPayment',
            'statusMessages',
            'employees'
        ));
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

    public function checkAndUpdateContractStatus(Contract $contract)
    {
        // Chỉ kiểm tra với hợp đồng đang tiến hành
        if ($contract->contract_status_id == Contract::STATUS_IN_PROGRESS) {
            // Kiểm tra đã thanh toán đủ chưa
            $totalPaid = Payment_history::where('related_id', $contract->id)
                ->where('transaction_type', 'contract')
                ->sum('amount');

            // Kiểm tra đã giao đủ hàng chưa
            $allProductsDelivered = true;
            foreach ($contract->contractDetails as $detail) {
                if ($detail->remaining_quantity > 0) {
                    $allProductsDelivered = false;
                    break;
                }
            }

            // Kiểm tra tất cả đơn hàng đã thành công chưa
            $allOrdersCompleted = true;
            foreach ($contract->orders as $order) {
                if ($order->status_id != 4) {
                    $allOrdersCompleted = false;
                    break;
                }
            }

            // Kiểm tra có quá hạn không
            $isOverdue = now()->gt($contract->timeend);

            // Cập nhật trạng thái
            $shouldComplete = $totalPaid >= $contract->total_amount
                && $allProductsDelivered
                && $allOrdersCompleted
                && !$isOverdue;

            if ($isOverdue) {
                $contract->contract_status_id = Contract::STATUS_EXPIRED;
            } elseif ($shouldComplete) {
                $contract->contract_status_id = Contract::STATUS_COMPLETED;
            }

            // Nếu có sự thay đổi trạng thái
            if ($contract->isDirty('contract_status_id')) {
                $contract->save();
                Contract_status_time::create([
                    'contract_id' => $contract->id,
                    'contract_status_id' => $contract->contract_status_id
                ]);
                event(new ContractStatusUpdated($contract));
            }
        }
    }


    // Method để validate trạng thái hợp đồng
    public function validateContractStatus($contract_id)
    {
        $contract = Contract::findOrFail($contract_id);
        if ($contract->contract_status_id != 6) {
            return response()->json([
                'success' => false,
                'message' => 'Hợp đồng phải được khách hàng xác nhận trước khi thực hiện thao tác này'
            ], 403);
        }
        return true;
    }
}
