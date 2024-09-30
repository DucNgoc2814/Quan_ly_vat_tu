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
use Illuminate\Http\Request;

class ImportOrderController extends Controller
{
    const PATH_VIEW = 'admin.components.import_orders.';

    public function index()
    {
        $data = Import_order::with(['payment', 'supplier'])->get();

        $lowStockProducts = Variation::with('product')
            ->where('stock', '<=', 30)
            ->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'lowStockProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payments = Payment::query()->get();
        $suppliers = Supplier::query()->get();
        $variants = Variation::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact("payments", "suppliers", "variants"));
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
                $slug = 'DHN' . $randomChars . $timestamp;

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


    //  public function store(StoreImport_orderRequest $request)
    // {
    //     // Lưu dữ liệu tạm thời vào session
    //     session(['temp_import_order' => $request->all()]);

    //     // Chuyển hướng về dashboard với thông báo
    //     return redirect()->route('admin.dashboard')->with('import_order_request', true);
    // }

    // public function confirmStore(Request $request)
    // {
    //     $tempData = session('temp_import_order');
    //     if (!$tempData) {
    //         return response()->json(['error' => 'Không tìm thấy dữ liệu đơn hàng tạm thời'], 400);
    //     }

    //     date_default_timezone_set('Asia/Ho_Chi_Minh');
    //     try {
    //         DB::transaction(function () use ($tempData) {
    //             $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
    //             $timestamp = now()->format('His');
    //             $slug = 'DHN' . $randomChars . $timestamp;

    //             $importOrder = Import_order::create([
    //                 "payment_id" => $tempData['payment_id'],
    //                 "supplier_id" => $tempData['supplier_id'],
    //                 "slug" => $slug,
    //                 "product_quantity" => $tempData['product_quantity'],
    //                 "total_amount" => $tempData['total_amount'],
    //                 "paid_amount" => $tempData['paid_amount'],
    //             ]);

    //             if (is_array($tempData['variation_id']) && count($tempData['variation_id']) > 0) {
    //                 foreach ($tempData['variation_id'] as $key => $variationID) {
    //                     $quantity = $tempData['product_quantity'][$key];

    //                     Import_order_detail::create([
    //                         'import_order_id' => $importOrder->id,
    //                         'variation_id' => $variationID,
    //                         'quantity' => $quantity,
    //                         'price' => $tempData['product_price'][$key],
    //                     ]);

    //                     $variation = Variation::find($variationID);
    //                     $variation->stock += $quantity;
    //                     $variation->save();
    //                 }
    //             } else {
    //                 throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng nhập');
    //             }
    //         });

    //         // Xóa dữ liệu tạm thời khỏi session
    //         session()->forget('temp_import_order');

    //         return response()->json(['success' => true, 'message' => 'Đơn hàng nhập đã được tạo thành công']);
    //     } catch (\Throwable $th) {
    //         return response()->json(['error' => 'Có lỗi xảy ra khi tạo đơn hàng nhập: ' . $th->getMessage()], 500);
    //     }
    // }


    public function show($slug)
    {
        $import_order = Import_order::where('slug', $slug)->firstOrFail();
        $payments = Payment::pluck('name', 'id')->all();
        $suppliers = Supplier::pluck('name', 'id')->all();
        $importOrderDetails = $import_order->importOrderDetails()->with('variations.product')->get();

        $variations = Variation::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('import_order', 'payments', 'suppliers', 'variations', 'importOrderDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $import_order = Import_order::where('slug', $slug)->firstOrFail();
        $payments = Payment::pluck('name', 'id')->all();
        $suppliers = Supplier::pluck('name', 'id')->all();
        $importOrderDetails = Import_order_detail::where('import_order_id', $import_order->id)->get();
        $variations = Variation::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('import_order', 'payments', 'suppliers', 'variations', 'importOrderDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImport_orderRequest $request, $slug)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // dd('a');
        try {
            DB::transaction(function () use ($request, $slug) {

                // lấy đơn hàng theo slug
                $importOrder = Import_order::where('slug', $slug)->firstOrFail();

                // Kiểm tra tính họp lệ của trạng thái mới

                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, length: 3);
                $timestamp = now()->format('His');
                $slug = 'DH' . $randomChars . $timestamp;

                $importOrderData = [
                    "payment_id" => $request->payment_id,
                    "supplier_id" => $request->supplier_id,
                    "product_quantity" => $request->product_quantity,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ];

                $importOrder->update($importOrderData);
                // Trả lại số lượng hàng tồn kho trước khi cập nhật
                foreach ($importOrder->importOrderDetails as $detail) {
                    $variation = Variation::findOrFail($detail->variation_id);
                    $variation->stock += $detail->quantity; // Trả lại số lượng đã bán trước đó
                    $variation->save();
                }

                // xóa chi tiết đơn hàng cũ
                $importOrder->importOrderDetails()->delete();

                if (is_array($request->variation_id) && count($request->variation_id) > 0) {

                    foreach ($request->variation_id as $key => $variationID) {

                        // kiểm tra tính tồn tại của các mảng liên quan
                        $quantity = $request->product_quantity[$key] ?? null;
                        $price = $request->product_price[$key] ?? null;

                        if ($variationID && $quantity && $price) {

                            $variation = Variation::findOrFail($variationID);

                            Import_order_detail::query()->create([
                                'import_order_id' => $importOrder->id,
                                'variation_id' => $variationID,
                                'quantity' => $quantity,
                                'price' => $price,
                            ]);

                            // Giảm số lượng hàng tồn kho
                            $variation->stock -= $quantity;
                            $variation->save();
                        }
                    }
                } else {
                    throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng nhập');
                }
            });
            return redirect()->route('importOrder.index')->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật đơn hàng nhập: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Import_order $import_order)
    {
        //
    }



    // public function checkLowStock()
    // {
    //     $lowStockProducts = Variation::with('product')
    //         ->where('stock', '<=', 30)
    //         ->get();

    //     return response()->json($lowStockProducts);
    // }
}
