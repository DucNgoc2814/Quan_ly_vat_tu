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
use App\Models\NewOrderRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ImportOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
                $timestamp = now()->format('His');
                $slug = 'DHN' . $randomChars . $timestamp;

                // Tạo đơn hàng nhập
                $importOrder = Import_order::create([
                    "payment_id" => $request->payment_id,
                    "supplier_id" => $request->supplier_id,
                    "slug" => $slug,
                    "product_quantity" => array_sum($request->product_quantity),
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                    "status" => 1, // Trạng thái ban đầu là chờ xác nhận
                ]);

                // Lưu thông tin tạm vào bảng new_order_requests
                if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                    foreach ($request->variation_id as $key => $variationID) {
                        $quantity = $request->product_quantity[$key];

                        NewOrderRequest::create([
                            'import_order_id' => $importOrder->id,
                            'product' => $variationID,
                            'quantity' => $quantity,
                        ]);
                    }
                } else {
                    throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng nhập');
                }
            });

            // Chuyển hướng về trang index và hiển thị thông báo
            return redirect()->route('importOrder.index')->with('success', 'Đơn hàng của bạn đã được gửi đến quản lý, chờ quản lý xác nhận');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng nhập: ' . $th->getMessage());
        }
    }

    public function requestCancel(Request $request, $slug)
    {
        $importOrder = Import_order::where('slug', $slug)->firstOrFail();

        // Cập nhật trạng thái về chờ hủy (tạm gọi là 1)
        $importOrder->status = 1;
        $importOrder->cancel_reason = $request->reason; // Lưu lý do hủy
        $importOrder->save();

        return response()->json(['success' => true, 'message' => 'Chờ quản lý xác nhận hủy']);
    }

    public function getPendingCancelRequests()
    {
        // Lấy các yêu cầu hủy đơn hàng có trạng thái đang chờ xử lý
        $pendingRequests = Import_order::where('status', 1) // 1 = Chờ xác nhận
            ->whereNotNull('cancel_reason') // Chỉ lấy đơn có yêu cầu hủy
            ->get();

        return response()->json($pendingRequests);
    }

    public function cancelImportOrder($slug)
    {
        $importOrder = Import_order::where('slug', $slug)->firstOrFail();
        $importOrder->status = 4; // Chuyển trạng thái thành hủy
        $importOrder->save();

        return redirect()->back()->with('success', 'Đơn hàng đã bị hủy');
    }

    public function confirmOrder($slug)
    {
        $importOrder = Import_order::where('slug', $slug)->firstOrFail();
        $importOrder->status = 2; // Đã xác nhận
        $importOrder->save();

        return response()->json(['success' => true, 'message' => 'Đã xác nhận đơn hàng, chờ cập nhật số lượng']);
    }

    public function autoUpdateStatus($slug)
    {
        $importOrder = Import_order::where('slug', $slug)->firstOrFail();
        if ($importOrder->status == 2) {
            $importOrder->status = 3; // Giao hàng thành công
            $importOrder->save();

            // Cập nhật số lượng stock
            $newOrderRequests = NewOrderRequest::where('import_order_id', $importOrder->id)->get();
            foreach ($newOrderRequests as $request) {
                $variation = Variation::find($request->product);
                $variation->stock += $request->quantity;
                $variation->save();
            }

            return response()->json(['success' => true, 'message' => 'Đã giao hàng thành công và cập nhật số lượng']);
        }

        return response()->json(['success' => false, 'message' => 'Đơn hàng chưa sẵn sàng để cập nhật']);
    }

    public function dashboard()
    {
        $pendingNewOrders = NewOrderRequest::whereHas('importOrder', function ($query) {
            $query->where('status', 1);
        })->get();

        return view('admin.dashboard', compact('pendingNewOrders'));
    }









    public function show($slug)
    {

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

}
