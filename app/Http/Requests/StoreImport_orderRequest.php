<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImport_orderRequest extends FormRequest
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
            'supplier_id' => 'required|exists:suppliers,id',
            'variation_id' => 'required|array',
            'variation_id.*' => 'required|exists:variations,id',
            'product_quantity' => 'required|array',
            'product_quantity.*' => 'required|integer|min:1',
            'product_price' => 'required|array',
            'product_price.*' => 'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'supplier_id.required' => 'Vui lòng chọn nhà cung cấp',
            'supplier_id.exists' => 'Nhà cung cấp không tồn tại',
            
            'variation_id.required' => 'Vui lòng chọn ít nhất một sản phẩm',
            'variation_id.array' => 'Dữ liệu sản phẩm không hợp lệ',
            'variation_id.*.required' => 'Vui lòng chọn sản phẩm',
            'variation_id.*.exists' => 'Sản phẩm không tồn tại',
            
            'product_quantity.required' => 'Vui lòng nhập số lượng',
            'product_quantity.array' => 'Dữ liệu số lượng không hợp lệ',
            'product_quantity.*.required' => 'Vui lòng nhập số lượng cho tất cả sản phẩm',
            'product_quantity.*.integer' => 'Số lượng phải là số nguyên',
            'product_quantity.*.min' => 'Số lượng phải lớn hơn 0',
            
            'product_price.required' => 'Vui lòng nhập giá',
            'product_price.array' => 'Dữ liệu giá không hợp lệ',
            'product_price.*.required' => 'Vui lòng nhập giá cho tất cả sản phẩm',
            'product_price.*.numeric' => 'Giá phải là số',
            'product_price.*.min' => 'Giá phải lớn hơn hoặc bằng 0',
            
            'total_amount.required' => 'Tổng tiền không được để trống',
            'total_amount.numeric' => 'Tổng tiền phải là số',
            'total_amount.min' => 'Tổng tiền phải lớn hơn hoặc bằng 0',
            
            'paid_amount.required' => 'Số tiền đã trả không được để trống',
            'paid_amount.numeric' => 'Số tiền đã trả phải là số',
            'paid_amount.min' => 'Số tiền đã trả phải lớn hơn hoặc bằng 0'
        ];
    }
}
