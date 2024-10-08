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
use App\Models\Attribute;
use Illuminate\Support\Facades\Storage;
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
        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributesArray = Attribute::with('attributeValues')->get()->toArray();
        $categories = Category::pluck('name', 'id');
        $brands =  Brand::pluck('name', 'id');
        $units =  Unit::pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'brands', 'units', 'attributesArray'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        dd($request->attribute_value_id);
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

                if ($request->hasFile('product_images')) {
                    foreach ($request->file('product_images') as $image) {
                        $path = Storage::put('galleries', $image);
                        $product->galleries()->create(['url' => $path]);
                    }
                }

                $variantPrices = $request->variant_prices;
                $variantStocks = $request->variant_stocks;
                $selectedVariants = $request->variant_types;

                // Iterate over each combination of variants
                foreach ($variantPrices as $index => $price) {
                    $stock = $variantStocks[$index];

                    // Assuming you have a ProductVariant model and relationship
                    $product->variants()->create([
                        'variant_types' => json_encode($selectedVariants[$index]), // store variant types as JSON
                        'price' => $price,
                        'stock' => $stock,
                    ]);
                }
            }, 3);
            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
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
