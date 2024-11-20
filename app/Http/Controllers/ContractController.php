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
            $wordFile = $this->exportContractToWord($contract, $request);
            $contract->update([
                'file' => $wordFile
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

        // Thay thế các thông tin cơ bản
        $templateProcessor->setValue('contract_name', $contract->contract_name);
        $templateProcessor->setValue('customer_name', $contract->customer_name);
        $templateProcessor->setValue('customer_phone', $contract->customer_phone);
        $templateProcessor->setValue('customer_email', $contract->customer_email);

        // Chuẩn bị dữ liệu cho bảng
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

        // Thêm dữ liệu vào bảng
        $templateProcessor->cloneRowAndSetValues('stt', $tableData);

        // Thêm tổng tiền và thời gian
        $templateProcessor->setValue('total_amount', number_format($totalAmount) . ' VNĐ');
        $templateProcessor->setValue('timestart', date('d/m/Y', strtotime($contract->timestart)));
        $templateProcessor->setValue('timeend', date('d/m/Y', strtotime($contract->timeend)));

        $newFileName = 'Hopdong_' . $contract->id . '.docx';
        $newFilePath = storage_path('app/public/contracts/' . $newFileName);
        $templateProcessor->saveAs($newFilePath);

        return 'contracts/' . $newFileName;
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
        $fileName = 'Hopdong_' . $contract->id . '.docx';
        $filePath = storage_path('app/public/contracts/' . $fileName);

        $token = Str::random(60);
        $contract->verification_token = $token;
        $contract->save();

        $baseUrl = config('app.url');

        Mail::send('emails.contract', [
            'contract' => $contract,
            'token' => $token,
            'baseUrl' => $baseUrl
        ], function ($message) use ($contract, $filePath, $baseUrl) {
            $message->to($contract->customer_email)
                ->subject('Hợp đồng của bạn')
                ->attach($filePath, [
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
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
