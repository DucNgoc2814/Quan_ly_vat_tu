<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use App\Models\Gallery;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Lấy ID của sản phẩm từ slug
        $productId = Product::where('slug', $this->route('slug'))->first()->id;

        // Lấy số lượng ảnh hiện tại
        $currentImagesCount = Gallery::where('product_id', $productId)->count();

        // Lấy số lượng ảnh sẽ xóa
        $imagesToDelete = $this->input('images_to_delete', []);
        $deleteCount = count(array_filter($imagesToDelete));

        // Kiểm tra có ảnh mới không
        $hasNewImages = $this->hasFile('product_images');

        // Nếu xóa hết ảnh cũ và không có ảnh mới
        $imageRule = ($deleteCount == $currentImagesCount && !$hasNewImages) ? 'required' : 'nullable';
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'unique:products,name,' . $productId,
                'regex:/^(?![0-9]+$).*/',
            ],
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'unit_id' => 'required|exists:units,id',
            'description' => 'required|string|min:10|regex:/^(?![0-9]+$).*/',
            'product_images' => $imageRule,
            'product_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images_to_delete.*' => 'nullable|exists:galleries,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.string' => 'Tên sản phẩm phải là chuỗi ký tự',
            'name.min' => 'Tên sản phẩm phải có ít nhất 3 ký tự',
            'name.max' => 'Tên sản phẩm không được vượt quá 100 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'name.regex' => 'Tên sản phẩm không được chỉ chứa số',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
            'category_id.exists' => 'Danh mục sản phẩm không tồn tại',
            'brand_id.required' => 'Vui lòng chọn thương hiệu',
            'brand_id.exists' => 'Thương hiệu không tồn tại',
            'unit_id.required' => 'Vui lòng chọn đơn vị tính',
            'unit_id.exists' => 'Đơn vị tính không tồn tại',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'description.min' => 'Mô tả sản phẩm phải có ít nhất 10 ký tự',
            'description.regex' => 'Mô tả sản phẩm không được chỉ chứa số',
            'product_images.required' => 'Sản phẩm phải có ít nhất một ảnh. Vui lòng thêm ảnh mới hoặc giữ lại ảnh cũ',
            'product_images.*.image' => 'File phải là hình ảnh',
            'product_images.*.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg hoặc gif',
            'product_images.*.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá sản phẩm',
            'category_id' => 'Danh mục',
            'brand_id' => 'Thương hiệu',
            'unit_id' => 'Đơn vị tính',
            'description' => 'Mô tả',
            'product_images.*' => 'Hình ảnh',
            'variations.*.price_export' => 'Giá biến thể',
        ];
    }
}
