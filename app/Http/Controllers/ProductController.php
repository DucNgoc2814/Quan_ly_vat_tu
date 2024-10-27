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
use App\Models\Gallery;
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
                $variations = $request->variants;
                foreach ($variations as $variantId => $data) {
                    $variantName = $request->name . ' (' . implode(', ', $data['attribute_value_values']) . ')';
                    $variation = Variation::create([
                        'product_id' => $product->id,
                        'sku' => $this->generateUniqueSku(),
                        'name' => $variantName,
                        'stock' => $data['stock'],
                        'price_export' => $data['price'] ? $data['price'] : $request->price,
                        'is_active' => true,
                    ]);
                    $variation->attributeValues()->attach($data['attribute_value_ids']);
                }
            }, 3);
            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');;
        } catch (\Throwable $th) {
            // Trả về trang trước đó với thông báo lỗi, nhưng không dừng chương trình
            return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::with('variations')->findOrFail($id);
        $categories = Category::pluck('name', 'id');
        $units = Unit::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $attributes = Attribute::whereHas('attributeValues.variations', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })
            ->with('attributeValues.variations')
            ->get();
        $attributesArray = Attribute::with('attributeValues')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories', 'units', 'brands', 'attributes', 'attributesArray'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $product = Product::findOrFail($id);
                
                // Lấy tên sản phẩm cũ để so sánh
                $oldName = $product->name;
                $newName = $request->name;

                // Cập nhật thông tin cơ bản của sản phẩm
                $product->update([
                    'name' => $newName,
                    'price' => $request->price,
                    'category_id' => $request->category_id,
                    'brand_id' => $request->brand_id,
                    'unit_id' => $request->unit_id,
                    'description' => $request->description,
                    'is_active' => $request->has('is_active'),
                    'slug' => Str::slug($newName)
                ]);

                // Nếu tên sản phẩm thay đổi, cập nhật tên biến thể
                if ($oldName !== $newName) {
                    foreach ($product->variations as $variation) {
                        // Thay thế tên cũ trong tên biến thể bằng tên mới
                        $newVariationName = str_replace($oldName, $newName, $variation->name);
                        $variation->update([
                            'name' => $newVariationName
                        ]);
                    }
                }

                // Xử lý xóa ảnh
                $imagesToDelete = array_filter($request->input('images_to_delete', []));
                if (!empty($imagesToDelete)) {
                    foreach ($imagesToDelete as $galleryId) {
                        $gallery = Gallery::find($galleryId);
                        if ($gallery) {
                            if (Storage::exists($gallery->url)) {
                                Storage::delete($gallery->url);
                            }
                            $gallery->delete();
                        }
                    }
                }

                // Xử lý thêm ảnh mới
                if ($request->hasFile('product_images')) {
                    foreach ($request->file('product_images') as $image) {
                        if ($image->isValid()) {
                            $path = Storage::put('galleries', $image);
                            $product->galleries()->create(['url' => $path]);
                        }
                    }
                }

                // Xử lý cập nhật biến thể
                if ($request->has('variations')) {
                    foreach ($request->variations as $variationId => $data) {
                        $variation = Variation::find($variationId);
                        if ($variation) {
                            $variation->update([
                                'price_export' => $data['price_export'],
                                'stock' => $data['stock']
                            ]);
                        }
                    }
                }
            });

            return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Lỗi cập nhật sản phẩm: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function generateUniqueSku()
    {
        $sku = Str::random(8); // Bạn có thể thay đổi độ dài tùy theo yêu cầu

        while (Variation::where('sku', $sku)->exists()) {
            $sku = Str::random(8); // Tạo lại mã nếu đã tồn tại
        }

        return $sku; // Trả về mã SKU duy nhất
    }
}
