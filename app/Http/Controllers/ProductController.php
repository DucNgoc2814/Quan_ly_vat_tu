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

     public function edit($id)
     {
         // Lấy sản phẩm từ cơ sở dữ liệu
         $product = Product::findOrFail($id);
     
         // Lấy tất cả hình ảnh của sản phẩm
         $images = Gallery::where('product_id', $id)->get();
     
         // Lấy danh sách danh mục, thương hiệu, và đơn vị
         $categories = Category::all()->pluck('name', 'id');
         $brands = Brand::all()->pluck('name', 'id');
         $units = Unit::all()->pluck('name', 'id');
     
         // Lấy tất cả thuộc tính và giá trị của chúng
         $attributes = Attribute::with('attributeValues')->get();
         
         $attributesArray = [];
         foreach ($attributes as $attribute) {
             // Kiểm tra xem thuộc tính có giá trị không trước khi gọi pluck()
             $attributesArray[$attribute->id] = $attribute->attributeValues ? $attribute->attributeValues->pluck('value', 'id')->toArray() : [];
         }
         // Truyền dữ liệu vào view
         return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'images', 'categories', 'brands', 'units', 'attributesArray'));
     }
     




     public function update(StoreProductRequest $request, $id)
     {
         DB::transaction(function () use ($request, $id) {
             // Lấy sản phẩm để cập nhật
             $product = Product::findOrFail($id);
             
             // Cập nhật thông tin sản phẩm
             $product->update([
                 'name' => $request->name,
                 'price' => $request->price,
                 'category_id' => $request->category_id,
                 'brand_id' => $request->brand_id,
                 'unit_id' => $request->unit_id,
                 'description' => $request->description,
                 'is_active' => $request->has('is_active') ? 1 : 0
             ]);
     
             // Cập nhật ảnh sản phẩm
             if ($request->hasFile('product_images')) {
                 foreach ($request->file('product_images') as $image) {
                     // Lưu ảnh vào thư mục 'galleries'
                     $imagePath = $image->store('galleries', 'public');
                     Gallery::create([
                         'product_id' => $product->id,
                         'image_path' => $imagePath,
                     ]);
                 }
             }
     
             // Cập nhật biến thể sản phẩm
             if ($request->has('variant_types')) {
                 // Xóa các biến thể cũ (nếu cần)
                 $product->variants()->delete();
                 // Tạo biến thể mới từ request
                 foreach ($request->variant_types as $variantType) {
                     $product->variants()->create(['attribute_id' => $variantType]);
                 }
             }
     
             // Thông báo thành công và chuyển hướng
             return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công!');
         });
     
         // Nếu có lỗi, chuyển hướng về lại trang edit với thông báo lỗi
         return back()->withInput()->withErrors($request->errors());
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
        // Tạo mã SKU ngẫu nhiên
        $sku = Str::random(8); // Bạn có thể thay đổi độ dài tùy theo yêu cầu

        // Kiểm tra xem mã SKU đã tồn tại trong bảng variations chưa
        while (Variation::where('sku', $sku)->exists()) {
            $sku = Str::random(8); // Tạo lại mã nếu đã tồn tại
        }

        return $sku; // Trả về mã SKU duy nhất
    }
}
