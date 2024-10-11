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
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|string|max:255|unique:products',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'product_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'variants.*.attribute_value_ids' => 'required|array', // Ensure each variant has attribute values
            'variants.*.attribute_value_ids.*' => 'exists:attribute_values,id',
            'variants.*.price' => 'nullable|integer|min:0', // Price can be nullable, will default to product price
            'variants.*.stock' => 'required|integer|min:0', // Stock is required for each variant
        ];
    }

    /**
     * Custom validation error messages.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'unit_id.required' => 'Đơn vị là bắt buộc.',
            'unit_id.exists' => 'Đơn vị không hợp lệ.',
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.integer' => 'Giá phải là số nguyên.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',
            'product_images.*.image' => 'Mỗi tệp phải là một hình ảnh.',
            'product_images.*.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'product_images.*.max' => 'Hình ảnh không được vượt quá 2MB.',
            'variants.*.attribute_value_ids.required' => 'Biến thể phải có ít nhất một giá trị thuộc tính.',
            'variants.*.attribute_value_ids.*.exists' => 'Giá trị thuộc tính không hợp lệ.',
            'variants.*.price.integer' => 'Giá chi tiết phải là số nguyên.',
            'variants.*.price.min' => 'Giá chi tiết phải lớn hơn hoặc bằng 0.',
            'variants.*.stock.required' => 'Số lượng của biến thể là bắt buộc.',
            'variants.*.stock.integer' => 'Số lượng phải là số nguyên.',
            'variants.*.stock.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
        ];
    }
}
