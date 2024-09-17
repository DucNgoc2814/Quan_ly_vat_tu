<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'customer_name' => 'required|string|max:255',
            'number_phone' => 'required|regex:/^(0[0-9]{9,10})$/|unique:customers',
            'email' => 'required|email|max:255',
            'address'=> 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'product_variant' => 'required|array',
            'product_variant.*' => 'exists:variations,id',
            'product_quantity' => 'required|array',
            'product_quantity.*'=> 'numeric|min:1',
            'total_amount'=> 'required|numeric|min:0',,
            'paid_amount'=> 'required|numeric|min:0|lte:total_amount',,
        ];
    }

    public function messages()
{
    return [
        'customer_id.required' => 'Vui lòng chọn khách hàng.',
        'customer_id.exists' => 'Khách hàng không tồn tại trong hệ thống.',
        'customer_name.required' => 'Tên khách hàng không được để trống.',
        'customer_name.string' => 'Tên khách hàng phải là chuỗi ký tự.',
        'customer_name.max' => 'Tên khách hàng không được vượt quá 255 ký tự.',
        'number_phone.required' => 'Số điện thoại không được để trống.',
        'number_phone.regex' => 'Số điện thoại không hợp lệ.',
        'number_phone.unique' => 'Số điện thoại đã được sử dụng.',
        'email.required' => 'Email không được để trống.',
        'email.email' => 'Email không đúng định dạng.',
        'email.max' => 'Email không được vượt quá 255 ký tự.',
        'address.required' => 'Địa chỉ không được để trống.',
        'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
        'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        'product_id.required' => 'Vui lòng chọn ít nhất một sản phẩm.',
        'product_id.array' => 'Danh sách sản phẩm không hợp lệ.',
        'product_id.*.exists' => 'Sản phẩm không tồn tại trong hệ thống.',
        'product_variant.required' => 'Vui lòng chọn biến thể sản phẩm.',
        'product_variant.array' => 'Danh sách biến thể không hợp lệ.',
        'product_variant.*.exists' => 'Biến thể sản phẩm không tồn tại trong hệ thống.',
        'product_quantity.required' => 'Vui lòng nhập số lượng sản phẩm.',
        'product_quantity.array' => 'Danh sách số lượng không hợp lệ.',
        'product_quantity.*.numeric' => 'Số lượng sản phẩm phải là số.',
        'product_quantity.*.min' => 'Số lượng sản phẩm phải lớn hơn 0.',
        'total_amount.required' => 'Tổng giá trị đơn hàng không được để trống.',
        'total_amount.numeric' => 'Tổng giá trị đơn hàng phải là số.',
        'total_amount.min' => 'Tổng giá trị đơn hàng không được âm.',
        'paid_amount.required' => 'Số tiền đã trả không được để trống.',
        'paid_amount.numeric' => 'Số tiền đã trả phải là số.',
        'paid_amount.min' => 'Số tiền đã trả không được âm.',
        'paid_amount.lte' => 'Số tiền đã trả không được lớn hơn tổng giá trị đơn hàng.',
    ];
}

}
