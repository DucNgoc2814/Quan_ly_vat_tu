<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variation;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Unit;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.product.';

    public function index()
    {
        $products = Product::query()->with('category', 'brand', 'unit', 'variations.importOrderDetails')->get();
        $products = Product::query()->with('category', 'brand', 'unit', 'variations.importOrderDetails')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =  Category::pluck('name', 'id');
        $brands =  Brand::pluck('name', 'id');
        $units =  Unit::pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'brands', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $timestamp = now()->format('His_dmY');
                $slug = 'DH' . $randomChars . $timestamp;

                $dataOrder = [
                    "payment_id" => $request->payment_id,
                    "customer_id" => $request->customer_id,
                    "status_id" => 1, // Trạng thái mặc định 'Chờ xác nhận'
                    "slug" => $slug,
                    "customer_name" => $request->customer_name ?? $customers->name,
                    "email" => $request->email ?? $customers->email,
                    "number_phone" => $request->number_phone ?? $customers->number_phone,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ];

                $order = Order::query()->create($dataOrder);

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

            return redirect()->route('quan-ly-don-hang.danh-sach-ban');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $th->getMessage());
        }
        try {
            DB::transaction(function () use ($request) {
                $timestamp = now()->format('His_dmY');
                $slug = 'DH' . $randomChars . $timestamp;

                $dataOrder = [
                    "payment_id" => $request->payment_id,
                    "customer_id" => $request->customer_id,
                    "status_id" => 1, // Trạng thái mặc định 'Chờ xác nhận'
                    "slug" => $slug,
                    "customer_name" => $request->customer_name ?? $customers->name,
                    "email" => $request->email ?? $customers->email,
                    "number_phone" => $request->number_phone ?? $customers->number_phone,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ];

                $order = Order::query()->create($dataOrder);

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

            return redirect()->route('quan-ly-don-hang.danh-sach-ban');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
