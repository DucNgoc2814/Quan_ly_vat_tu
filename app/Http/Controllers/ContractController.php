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
        try {
            // 1. Tạo hợp đồng mới với trạng thái mặc định là 1 (đang chờ)
            $contract = Contract::create([
                'contract_status_id' => 1,
                'contract_name' => $request->contract_name,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'file' => null
            ]);

            // 2. Lưu chi tiết các sản phẩm trong hợp đồng
            $variations = $request->variation_id ?? [];
            $quantities = $request->quantity ?? [];

            if (!empty($variations) && count($variations) > 0) {
                foreach ($variations as $key => $variation_id) {
                    if ($variation_id != 0 && isset($quantities[$key]) && $quantities[$key] > 0) {
                        ContractDetail::create([
                            'contract_id' => $contract->id,
                            'variation_id' => $variation_id,
                            'quantity' => $quantities[$key]
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
            return back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    public function exportContractToWord($contract, $request)
    {
        // Đường dẫn đến file Word mẫu
        $templatePath = storage_path('app/public/templates/hop-dong.docx'); // Giả sử file mẫu nằm trong thư mục storage

        // Tạo đối tượng TemplateProcessor để tải file mẫu
        $templateProcessor = new TemplateProcessor($templatePath);

        // Thay thế các placeholder trong template bằng dữ liệu hợp đồng
        $templateProcessor->setValue('contract_name', $contract->contract_name);
        $templateProcessor->setValue('customer_name', $contract->customer_name);
        $templateProcessor->setValue('customer_phone', $contract->customer_phone);
        $templateProcessor->setValue('customer_email', $contract->customer_email);

        // Kiểm tra và thêm thông tin chi tiết hợp đồng (sản phẩm)
        $productsText = "";
        $variations = $request->variation_id ?? [];
        $quantities = $request->quantity ?? [];

        if (!empty($variations) && count($variations) > 0) {
            foreach ($variations as $key => $variationID) {
                if ($variationID != 0 && isset($quantities[$key])) {
                    $variation = Variation::find($variationID);
                    $productName = $variation->name ?? 'Null';
                    $productQuantity = $quantities[$key];
                    $productsText .= $productName . " | Quantity: " . $productQuantity . "\n";
                }
            }
        }

        // Thay thế thông tin sản phẩm trong template
        $templateProcessor->setValue('products', $productsText);

        // Lưu file Word mới
        $newFileName = 'Hopdong_' . $contract->id . '.docx';
        $newFilePath = storage_path('app/public/contracts/' . $newFileName);

        // Lưu file đã chỉnh sửa vào thư mục public
        $templateProcessor->saveAs($newFilePath);

        // Trả về file cho người dùng hoặc có thể tự động lưu vào thư mục
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

        // Tạo token ngẫu nhiên
        $token = Str::random(60);

        // Lưu token vào database
        $contract->verification_token = $token;
        $contract->save();

        Mail::send('emails.contract', [
            'contract' => $contract,
            'token' => $token,
            'appUrl' => config('app.url')
        ], function ($message) use ($contract, $filePath) {
            $message->to($contract->customer_email)
                ->subject('Hợp đồng của bạn')
                ->attach($filePath);
        });

        // Cập nhật trạng thái hợp đồng
        $contract->contract_status_id = 5;
        $contract->save();

        return redirect()->back()->with('success', 'Đã gửi hợp đồng cho khách hàng thành công');
    }

    public function customerApprove($id)
    {
        $contract = Contract::findOrFail($id);
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract_number)
    {
        $data = Contract::where('contract_number', $contract_number)->firstOrFail();
        dd($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
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
                // Delete the old file if it exists
                if ($contract->file && Storage::disk('public')->exists($contract->file)) {
                    Storage::disk('public')->delete($contract->file);
                }
                // Store the new file
                $filePath = $request->file('file')->store('contracts', 'public');
            }

            // Update contract with new data
            $contract->update([
                'contract_number' => $data['contract_number'],
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'number_phone' => $data['number_phone'],
                'total_amount' => $data['total_amount'],
                'note' => $data['note'],
                'file' => $filePath ? $filePath : $contract->file, // Use old file if no new file is uploaded
            ]);

            return redirect()
                ->route('contract.index')
                ->with('success', 'Cập nhật hợp đồng thành công!');
        } catch (Exception $exception) {
            // Handle exception
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
