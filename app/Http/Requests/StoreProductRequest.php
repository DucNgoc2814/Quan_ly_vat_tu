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

        $rules = [
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|min:3|max:100|unique:products,name|regex:/^(?![0-9]+$).*/',
            'description' => 'required|string|min:10|regex:/^(?![0-9]+$).*/',
            'is_active' => 'boolean',
            'product_images' => 'required',
            'product_images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ];

        // Kiểm tra nếu product_type là "1" (sản phẩm biến thể)
        if (request()->product_type === '1') {
            $rules['variants'] = 'required|array|min:1';
            $rules['variants.*.attribute_value_ids'] = 'required|array';
            $rules['variants.*.attribute_value_values'] = 'required|array';
            $rules['variants.*.attribute_value_ids.*'] = 'exists:attribute_values,id';
        } 
        return $rules;
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
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'name.string' => 'Tên sản phẩm phải là chuỗi ký tự',
            'name.min' => 'Tên sản phẩm không được dưới 3 ký tự',
            'name.max' => 'Tên sản phẩm không được vượt quá 100 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'name.regex' => 'Tên sản phẩm không được chỉ chứa số',
            'description.string' => 'Mô tả sản phẩm phải là chuỗi ký tự',
            'description.regex' => 'Mô tả sản phẩm không được chỉ chứa số',
            'description.min' => 'Mô tả sản phẩm không được dưới 10 ký tự',
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
            'image.required' => 'Vui lòng chọn ảnh đại diện',
            'image.image' => 'Tệp tải lên phải là hình ảnh',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg hoặc gif',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB',
        ];
    }
}