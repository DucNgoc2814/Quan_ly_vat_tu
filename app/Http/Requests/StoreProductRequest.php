<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'product_images' => 'required',
            'product_images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'variants' => 'required|array|min:1',
            'variants.*.attribute_value_ids' => 'required|array',
            'variants.*.attribute_value_values' => 'required|array',
            'variants.*.attribute_value_ids.*' => 'exists:attribute_values,id',
            'variants.*.price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ];
    }

    /**
     * Custom validation error messages.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
            'category_id.exists' => 'Danh mục không tồn tại',
            'unit_id.required' => 'Vui lòng chọn đơn vị tính',
            'unit_id.exists' => 'Đơn vị tính không tồn tại',
            'brand_id.required' => 'Vui lòng chọn thương hiệu',
            'brand_id.exists' => 'Thương hiệu không tồn tại',
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.string' => 'Tên sản phẩm phải là chuỗi ký tự',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'price.min' => 'Giá sản phẩm không được nhỏ hơn 0',
            'product_images.required' => 'Vui lòng chọn ít nhất một ảnh',
            'product_images.array' => 'Dữ liệu ảnh không hợp lệ',
            'product_images.min' => 'Vui lòng chọn ít nhất một ảnh',
            'product_images.*.required' => 'Vui lòng chọn ảnh',
            'product_images.*.image' => 'File phải là hình ảnh',
            'product_images.*.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg hoặc gif',
            'variants.required' => 'Vui lòng thêm ít nhất một biến thể',
            'variants.array' => 'Dữ liệu biến thể không hợp lệ',
            'variants.min' => 'Vui lòng thêm ít nhất một biến thể',
            'variants.*.attribute_value_ids.required' => 'Vui lòng chọn giá trị thuộc tính',
            'variants.*.attribute_value_ids.array' => 'Dữ liệu giá trị thuộc tính không hợp lệ',
            'variants.*.attribute_value_values.required' => 'Vui lòng chọn giá trị thuộc tính',
            'variants.*.attribute_value_values.array' => 'Dữ liệu giá trị thuộc tính không hợp lệ',
            'variants.*.price.numeric' => 'Giá biến thể phải là số',
            'variants.*.price.min' => 'Giá biến thể không được nhỏ hơn 0',
            'variants.*.stock.required' => 'Vui lòng nhập số lượng tồn kho',
            'variants.*.stock.integer' => 'Số lượng tồn kho phải là số nguyên',
            'variants.*.stock.min' => 'Số lượng tồn kho không được nhỏ hơn 0',
        ];
    }
}
