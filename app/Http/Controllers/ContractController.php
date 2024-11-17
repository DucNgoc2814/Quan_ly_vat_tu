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
            ]);

            // 2. Lưu chi tiết các sản phẩm trong hợp đồng
            // Kiểm tra nếu variation_id và quantity không phải là null và có dữ liệu
            $variations = $request->variation_id ?? []; // Sử dụng toán tử ?? để tránh null
            $quantities = $request->quantity ?? [];

            if (!empty($variations) && count($variations) > 0) {
                foreach ($variations as $key => $variation_id) {
                    // Kiểm tra giá trị của variation_id và quantity tại vị trí tương ứng
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
            $this->exportContractToWord($contract, $request);  // Đổi tên phương thức ở đây

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
        $newFilePath = storage_path('app/public/' . $newFileName);

        // Lưu file đã chỉnh sửa vào thư mục public
        $templateProcessor->saveAs($newFilePath);

        // Trả về file cho người dùng hoặc có thể tự động lưu vào thư mục
        return response()->download($newFilePath)->deleteFileAfterSend(true);
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
    public function edit(Contract $contract)
    {
        dd($contract);
        $data = Contract::firstOrFail($contract);
        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $brand)
    {
        $data = $request->validated();
        try {
            $brand->update([
                'name' => $data['name'],
                'is_active' => isset($data['is_active']) ? 1 : 0,
            ]);
            return redirect()
                ->route('thuong-hieu.index')
                ->with('success', 'Thao tác thành công!');
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
