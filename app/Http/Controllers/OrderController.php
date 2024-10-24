<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Order_canceled;
use App\Models\Order_detail;
use App\Models\Order_status;
use App\Models\Payment;
use App\Models\Variation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Handles the CRUD operations for orders in the application.
 *
 * This controller provides methods to list, create, show, edit, update, and delete orders.
 * It interacts with various models such as Order, Customer, Order_detail, Order_status, Payment, Product, and Variation.
 * The controller also handles the creation of new orders, including generating a unique order slug and storing the order details.
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.components.orders.';

    // public function index(Request $request)
    // {
    //     $query = Order::query();

    //     if ($request->filled('search') && $request->filled('search_column')) {
    //         $searchTerm = $request->input('search');
    //         $searchColumn = $request->input('search_column');
    //         $query->where($searchColumn, 'LIKE', "%{$searchTerm}%");
    //     }

    //     if ($request->filled('orderDate')) {
    //         $date = $request->input('orderDate');
    //         $query->whereDate('created_at', $date);
    //     }

    //     $query->orderBy('created_at', 'desc');

    //     $data = $query->get();

    //     $columns = [
    //         'slug' => 'Mã đơn hàng',
    //         'created_at' => 'Ngày đặt hàng',
    //         'customer_name' => 'Tên người nhận',
    //         'number_phone' => 'Số điện thoại người nhận',
    //         'address' => 'Địa chỉ giao hàng',
    //     ];

    //     if ($data->isEmpty()) {
    //         $message = 'Không có đơn hàng nào cho tiêu chí tìm kiếm.';
    //         return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'message', 'columns'));
    //     }

    //     return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'columns'));
    // }


    public function index()
    {
        $data = Order::with(['payment', 'customer', 'orderStatus'])
            ->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        $payments = Payment::pluck('name', 'id')->all();
        $customers = Customer::get();
        $status = Order_status::pluck('description', 'id')->all();
        $variation = Variation::all();
        // $variation = Variation::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('payments', 'customers', 'status', 'variation'));
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(StoreOrderRequest $request)
    {
        // dd($request);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {

            DB::transaction(function () use ($request) {
                $customer_id = strtok($request->customer_id, ' ');
                $customers = Customer::findOrFail($request->customer_id);
                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, length: 3);
                $timestamp = now()->format('His');
                $slug = 'DHB' . $randomChars . $timestamp;
                $dataOrder = [
                    "payment_id" => $request->payment_id,
                    "customer_id" => $customer_id,
                    "status_id" => 1,
                    "slug" => $slug,
                    "customer_name" => $request->customer_name ?? $customers->name,
                    "email" => $request->email ?? $customers->email,
                    "number_phone" => $request->number_phone ?? $customers->number_phone,
                    "province" => $request->province_name,
                    "district" => $request->district_name,
                    "ward" => $request->ward_name,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ];

                $order = Order::query()->create($dataOrder);


                $existingLocation = Location::where('customer_id', $order->customer_id)
                ->where('customer_name', $order->customer_name)
                ->where('email', $order->email)
                ->where('number_phone', $order->number_phone)
                ->where('province', $order->province)
                ->where('district', $order->district)
                ->where('ward', $order->ward)
                ->where('address', $order->address)
                ->first();

            if (!$existingLocation) {
                $location = new Location();
                $location->customer_id = $order->customer_id;
                $location->customer_name = $order->customer_name;
                $location->email = $order->email;
                $location->number_phone = $order->number_phone;
                $location->province = $order->province;
                $location->district = $order->district;
                $location->ward = $order->ward;
                $location->address = $order->address;
                $location->is_active = false;
                $location->save();
            }

                if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                    foreach ($request->variation_id as $key => $variationID) {

                        // Tìm variation theo ID
                        $variation = Variation::findOrFail($variationID);
                        $orderQuantity = $request->product_quantity[$key];

                        // Thêm log kiểm tra số lượng tồn kho hiện tại và số lượng yêu cầu
                        logger("Số lượng tồn kho (stock) của variation $variationID là: " . $variation->stock);
                        logger("Số lượng mua của variation $variationID là: " . $orderQuantity);

                        // Kiểm tra số lượng tồn kho để tránh giảm quá số lượng hiện có
                        if ($orderQuantity > $variation->stock) {
                            throw new Exception('Số lượng mua vượt quá số lượng hàng tồn kho.');
                        }

                        // Tạo chi tiết đơn hàng
                        Order_detail::query()->create([
                            'order_id' => $order->id,
                            'variation_id' => $variationID,
                            'quantity' => $orderQuantity,
                            'price' => $request->product_price[$key],
                        ]);

                        // Giảm số lượng hàng tồn kho
                        $variation->stock -= $orderQuantity;
                        $variation->save();
                    }
                } else {
                    throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng');
                }

            });

            return redirect()->route('order.index')->with('success', 'Thêm mới đơn hàng thành công!');

            // dd(session('success'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $th->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();
        $payments = Payment::pluck('name', 'id')->all();
        $customers = Customer::pluck('name', 'id')->all();
        $status = Order_status::pluck('description', 'id')->all();
        $variation = Variation::all();
        // $variation = Variation::pluck('name', 'id')->all();
        $orderDetails = Order_detail::where('order_id', $order->id)->get();

        // dd($variation);
        return view(self::PATH_VIEW . __FUNCTION__, compact('order', 'payments', 'customers', 'status', 'variation', 'orderDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, $slug)
    {
        // dd($request->all());
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            DB::transaction(function () use ($request, $slug) {

                // lấy đơn hàng theo slug
                $order = Order::where('slug', $slug)->firstOrFail();

                // Kiểm tra tính họp lệ của trạng thái mới
                $currentStatus = $order->status_id;
                $newStatus = $request->status_id ?? $currentStatus;

                $dataOrder = [
                    "payment_id" => $request->payment_id,
                    "customer_id" => $request->customer_id,
                    "status_id" => $newStatus,
                    "customer_name" => $request->customer_name ?? $order->name,
                    "email" => $request->email ?? $order->email,
                    "number_phone" => $request->number_phone ?? $order->number_phone,
                    "province" => $request->province_name,
                    "district" => $request->district_name,
                    "ward" => $request->ward_name,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ];

                $order->update($dataOrder);

                // Trả lại số lượng hàng tồn kho trước khi cập nhật
                foreach ($order->orderDetails as $detail) {
                    $variation = Variation::findOrFail($detail->variation_id);
                    $variation->stock += $detail->quantity; // Trả lại số lượng đã bán trước đó
                    $variation->save();
                }

                // xóa chi tiết đơn hàng cũ
                $order->orderDetails()->delete();

                // Kiểm tra xem các mảng product_id có tồn tại hay ko

                if (is_array($request->variation_id) && count($request->variation_id) > 0) {

                    foreach ($request->variation_id as $key => $variationID) {

                        // kiểm tra tính tồn tại của các mảng liên quan
                        $quantity = $request->product_quantity[$key] ?? null;
                        $price = $request->product_price[$key] ?? null;

                        // Thêm chi tiết đơn hàng mới chỉ khi có đủ thông tin

                        if ($variationID && $quantity && $price) {

                            $variation = Variation::findOrFail($variationID);

                            Order_detail::query()->create([
                                'order_id' => $order->id,
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
                    throw new \Exception('Không có sản phẩm nào để cập nhật trong đơn hàng.');
                }
            });
            DB::commit();

            return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    public function updateStatus(Request $request, $slug)
    {
        DB::transaction(function () use ($request, $slug) {
            $order = Order::where('slug', $slug)->firstOrFail();
            $oldStatus = $order->status_id;
            $newStatus = $request->input('status');

            // Cập nhật trạng thái đơn hàng
            $order->status_id = $newStatus;
            $order->save();

            // Nếu trạng thái là hủy (5)
            if ($newStatus == 5 && $oldStatus != 5) {
                // Hoàn lại số lượng sản phẩm vào kho
                foreach ($order->orderDetails as $detail) {
                    $variation = Variation::findOrFail($detail->variation_id);
                    $variation->stock += $detail->quantity;
                    $variation->save();
                }

                // Lưu ghi chú vào bảng order_canceleds
                $canceledOrder = new Order_canceled();
                $canceledOrder->order_id = $order->id;
                $canceledOrder->note = $request->input('note');
                $canceledOrder->save();
            }
        });

        return redirect()->back()->with('message', 'Cập nhật trạng thái đơn hàng thành công!');
    }



}
