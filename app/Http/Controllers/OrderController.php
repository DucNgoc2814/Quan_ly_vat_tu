<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Order_detail;
use App\Models\Order_status;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Variation;
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

    const PATH_VIEW = 'admin.compoents.orders.';
    public function index()
    {

        $data = Order::with(['payment', 'customer', 'orderStatus'])->latest()->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payments = Payment::pluck('name', 'id')->all();
        $customers = Customer::get();
        $status = Order_status::pluck('description', 'id')->all();
        $products = Product::pluck('name', 'id')->all();
        $variation = Variation::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('payments', 'customers', 'status', 'products', 'variation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            DB::transaction(function () use ($request) {
                $customers = Customer::findOrFail($request->customer_id);

                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);
                $timestamp = now()->format('His_dmY');
                $slug = 'DH' . $randomChars . $timestamp;


                $dataOrder = [
                    "payment_id" => $request->payment_id,
                    "customer_id" => $request->customer_id,
                    "status_id" => 1,
                    "slug" => $slug,
                    "customer_name" => $request->customer_name ?? $customers->name,
                    "email" => $request->email ?? $customers->email,
                    "number_phone" => $request->number_phone ?? $customers->number_phone,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ];

                $order = Order::query()->create($dataOrder);

                foreach ($request->product_id as $key => $productID) {
                    Order_detail::query()->create([
                        'order_id' => $order->id,
                        'product_id' => $productID,
                        'variation_id' => $request->product_variant[$key],
                        'quantity' => $request->product_quantity[$key],
                        'price' => $request->product_price[$key],
                    ]);
                }
            });

            return redirect()->route('quan-ly-don-hang.danh-sach-ban');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
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
        $products = Product::pluck('name', 'id')->all();
        $variation = Variation::pluck('name', 'id')->all();
        $orderDetails = Order_detail::where('order_id', $order->id)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('order', 'payments', 'customers', 'status', 'products', 'variation', 'orderDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, $slug)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            DB::transaction(function () use ($request, $slug) {

                // lấy đơn hàng theo slug
                $order = Order::where('slug', $slug)->firstOrFail();

                $dataOrder = [
                    "payment_id" => $request->payment_id,
                    "customer_id" => $request->customer_id,
                    "status_id" => 1,
                    "customer_name" => $request->customer_name ?? $order->name,
                    "email" => $request->email ?? $order->email,
                    "number_phone" => $request->number_phone ?? $order->number_phone,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ];

                $order->update($dataOrder);

                $order->orderDetails()->delete();

                // Kiểm tra xem các mảng product_id có tồn tại hay ko

                if (is_array($request->product_id) && count($request->product_id) > 0) {

                    foreach ($request->product_id as $key => $productID) {

                        // kiểm tra tính tồn tại của các mảng liên quan
                        $variation_id = $request->product_variant[$key] ?? null;
                        $quantity = $request->product_quantity[$key] ?? null;
                        $price = $request->product_price[$key] ?? null;

                        // Thêm chi tiết đơn hàng mới chỉ khi có đủ thông tin

                        if ($productID && $variation_id && $quantity && $price) {

                            Order_detail::query()->create([
                                'order_id' => $order->id,
                                'product_id' => $productID,
                                'variation_id' => $variation_id,
                                'quantity' => $quantity,
                                'price' => $price,
                            ]);
                        }
                    }
                }
                else{
                    throw new \Exception('Không có sản phẩm nào để cập nhật trong đơn hàng.');
                }
            });
            DB::commit();

            return redirect()->route('quan-ly-don-hang.danh-sach-ban');
        } catch (\Throwable $th) {
            dd($th->getMessage());
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
}
