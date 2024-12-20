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
    const PATH_VIEW = 'admin.components.products.';

    public function index()
    {
        $products = Product::query()
            ->with('category', 'brand', 'unit', 'variations.importOrderDetails')
            ->get();


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
            DB::transaction(
                function () use ($request) {
                    if ($request->hasFile('image')) {
                        $mainImagePath = Storage::put('products', $request->file('image'));
                    }

                    // Create product with all required fields including image
                    $product = Product::create([
                        "category_id" => $request->category_id,
                        "unit_id" => $request->unit_id,
                        "brand_id" => $request->brand_id,
                        "slug" => Str::slug($request->name) . '-' . Str::random(5),
                        "name" => $request->name,
                        "description" => $request->description,
                        "is_active" => $request->has('is_active'),
                        "image" => $mainImagePath // Include image path in initial creation
                    ]);

                    // Xử lý ảnh sản phẩm phụ
                    if ($request->hasFile('product_images')) {
                        $galleries = [];
                        foreach ($request->file('product_images') as $image) {
                            $path = Storage::put('galleries', $image);
                            $galleries[] = ['url' => $path, 'product_id' => $product->id];
                        }
                        // Bulk insert galleries
                        Gallery::insert($galleries);
                    }

                    // Khởi tạo biến thể
                    $variations = [];
                    
                    if ($request->has('variants') && is_array($request->variants)) {
                        // Tạo biến thể cho sản phẩm có nhiều biến thể
                        foreach ($request->variants as $index => $variantData) {
                            $variantName = $request->name . ' (' . implode(', ', $variantData['attribute_value_values']) . ')';
                            $variations[] = [
                                'product_id' => $product->id,
                                'sku' => Str::upper($this->generateUniqueSku($index)),
                                'name' => $variantName,
                                'is_active' => false,
                            ];
                        }
                    } else {
                        // Tạo một biến thể mặc định cho sản phẩm đơn
                        $variations[] = [
                            'product_id' => $product->id,
                            'sku' => Str::upper($this->generateUniqueSku(rand(0, 9))),
                            'name' => $request->name,
                            'is_active' => true,
                        ];
                    }

                    // Insert variations
                    Variation::insert($variations);

                    // Gán giá trị thuộc tính cho biến thể chỉ khi có variants
                    if ($request->has('variants') && is_array($request->variants)) {
                        foreach ($request->variants as $index => $variantData) {
                            $variation = Variation::where('sku', Str::upper($this->generateUniqueSku($index)))
                                ->where('product_id', $product->id)
                                ->first();
                            if ($variation) {
                                $variation->attributeValues()->attach($variantData['attribute_value_ids']);
                            }
                        }
                    }
                }
            );
            return redirect()
                ->route('product.index')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($slug)
    {
        $product = Product::with('variations')->where('slug', $slug)->firstOrFail();
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

    public function update(UpdateProductRequest $request, $slug)
    {
        try {
            DB::transaction(function () use ($request, $slug) {
                $product = Product::with('galleries', 'variations')->where('slug', $slug)->firstOrFail();

                $oldName = $product->name;
                $newName = $request->name;

                // Cập nhật thông tin sản phẩm
                $product->update([
                    'name' => $newName,
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
                        $newVariationName = str_replace($oldName, $newName, $variation->name);
                        $variation->update(['name' => $newVariationName]);
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

                // Xử lý cập nhật ảnh sản phẩm chính
                if ($request->hasFile('image')) {
                    // Xóa ảnh cũ nếu có
                    if (Storage::exists($product->image)) {
                        Storage::delete($product->image);
                    }
                    $mainImagePath = Storage::put('products', $request->file('image'));
                    $product->image = $mainImagePath;
                    $product->save();
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

    public function generateUniqueSku($index)
    {
        $productType = 'SP';
        $date = now()->format('my'); // Sử dụng Carbon để lấy ngày tháng năm
        $randomNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $sku = $productType . $date . $randomNumber;
        return $sku; // Trả về mã SKU duy nhất
    }
}
