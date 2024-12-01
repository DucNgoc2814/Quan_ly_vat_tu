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
            'payment_id' => 'required',
            'supplier_id' => 'required',
            'variation_id' => 'required|array',
            'product_quantity' => 'required|array',
            'variation_id.*' => 'required|exists:variations,id',
            'product_price.*' => 'required|numeric|min:0',
            'product_quantity.*' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0'
        ];
    }
    public function messages(): array
    {
        return [
            'payment_id.required' => 'Vui lòng chọn phương thức thanh toán',
            'supplier_id.required' => 'Vui lòng chọn nhà cung cấp',
            'variation_id.required' => 'Vui lòng chọn sản phẩm',
            'variation_id.*.required' => 'Vui lòng chọn sản phẩm',
            'product_quantity.required' => 'Vui lòng nhập số lượng',
            'product_quantity.*.required' => 'Vui lòng nhập số lượng cho tất cả sản phẩm',
            'product_quantity.*.min' => 'Số lượng phải lớn hơn 0',
            'product_price.*.required' => 'Vui lòng nhập giá cho tất cả sản phẩm',
            'product_price.*.min' => 'Giá phải lớn hơn hoặc bằng 0',
            'paid_amount.required' => 'Vui lòng nhập số tiền đã trả',
            'paid_amount.min' => 'Số tiền đã trả phải lớn hơn hoặc bằng 0'
        ];
    }
}
