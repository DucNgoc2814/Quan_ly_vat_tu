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
use Illuminate\Support\Str;

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
                $slug = Str::slug($request['name']);
                $data = [
                    "category_id" => $request->category_id,
                    "unit_id" => $request->unit_id,
                    "brand_id" => $request->brand_id,
                    "slug" => $slug,
                    "name" => $request->name,
                    "price" => $request->price,
                    "description" => $request->description,
                    "is_active" => $request->has('is_active') ? 1 : 0,
                ];
                $product = Product::query()->create($data);

                // if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                //     foreach ($request->variation_id as $key => $variationID) {

                //         // Tìm variation theo ID
                //         $variation = Variation::findOrFail($variationID);
                //         $orderQuantity = $request->product_quantity[$key];

                //         // Thêm log kiểm tra số lượng tồn kho hiện tại và số lượng yêu cầu
                //         logger("Số lượng tồn kho (stock) của variation $variationID là: " . $variation->stock);
                //         logger("Số lượng mua của variation $variationID là: " . $orderQuantity);

                //         // Kiểm tra số lượng tồn kho để tránh giảm quá số lượng hiện có
                //         if ($orderQuantity > $variation->stock) {
                //             throw new Exception('Số lượng mua vượt quá số lượng hàng tồn kho.');
                //         }

                //         // Tạo chi tiết đơn hàng
                //         Order_detail::query()->create([
                //             'order_id' => $product->id,
                //             'variation_id' => $variationID,
                //             'quantity' => $orderQuantity,
                //             'price' => $request->product_price[$key],
                //         ]);

                //         // Giảm số lượng hàng tồn kho
                //         $variation->stock -= $orderQuantity;
                //         $variation->save();
                //     }
                // } else {
                //     throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng');
                // }
            });
            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');;
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
