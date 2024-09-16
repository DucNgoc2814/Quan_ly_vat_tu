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
        return view(self::PATH_VIEW . __FUNCTION__, compact('payments','customers','status','products','variation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $customers = Customer::findOrFail($request->customer_id);

                $latestOrder = Order::latest()->first();
                $orderNumber = $latestOrder ? (intval(substr($latestOrder->slug, -3)) + 1) : 1;
                $slug = 'order-' . str_pad($orderNumber, 3, '0', STR_PAD_LEFT);


                $dataOrder = [
                    "payment_id" => $request->payment_id,
                    "customer_id" => $request->customer_id,
                    "status_id" => $request->status_id,
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
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
