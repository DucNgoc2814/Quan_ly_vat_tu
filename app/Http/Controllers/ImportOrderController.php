<?php

namespace App\Http\Controllers;

use App\Models\Import_order_detail;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\Variation;
use App\Models\Import_order;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreImport_orderRequest;
use App\Http\Requests\UpdateImport_orderRequest;
use Exception;

class ImportOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Import_order::query()->get();
        return view("admin.components.import_orders.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payments = Payment::query()->get();
        $suppliers = Supplier::query()->get();
        $variants = Variation::all();
        return view("admin.components.import_orders.create", compact("payments", "suppliers", "variants"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImport_orderRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        try {
            DB::transaction(function () use ($request) {
                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, length: 3);
                $timestamp = now()->format('His');
                $slug = 'DH' . $randomChars . $timestamp;

                $importOrder = Import_order::create([
                    "payment_id" => $request->payment_id,
                    "supplier_id" => $request->supplier_id,
                    "slug" => $slug,
                    "product_quantity" => $request->product_quantity,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ]);

                if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                    foreach ($request->variation_id as $key => $variationID) {
                        $quantity = $request->product_quantity[$key];

                        // Tạo chi tiết đơn hàng nhập
                        Import_order_detail::create([
                            'import_order_id' => $importOrder->id,
                            'variation_id' => $variationID,
                            'quantity' => $quantity,
                            'price' => $request->product_price[$key],
                        ]);

                        // Cập nhật số lượng trong bảng variation
                        $variation = Variation::find($variationID);
                        $variation->stock += $quantity;
                        $variation->save();
                    }
                } else {
                    throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng nhập');
                }
            });

            return redirect()->route('importOrder.index')->with('success', 'Đơn hàng nhập đã được tạo thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng nhập: ' . $th->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Import_order $import_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Import_order $import_order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImport_orderRequest $request, Import_order $import_order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Import_order $import_order)
    {
        //
    }
}
