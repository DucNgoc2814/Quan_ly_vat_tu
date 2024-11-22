<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            'customer_email' => 'required|email|max:255',
            'variation_id' => 'required|array',
            'variation_id.*' => 'required|exists:variations,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1'

        ];
    }

    public function messages(): array
    {
        return [
            'contract_name.required' => 'Vui lòng nhập tên hợp đồng',
            'contract_name.max' => 'Tên hợp đồng không được vượt quá 255 ký tự',
            'customer_name.required' => 'Vui lòng nhập tên khách hàng',
            'customer_name.max' => 'Tên khách hàng không được vượt quá 255 ký tự',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            'customer_phone.regex' => 'Số điện thoại không hợp lệ',
            'customer_phone.min' => 'Số điện thoại phải có ít nhất 10 số',
            'customer_phone.max' => 'Số điện thoại không được vượt quá 11 số',
            'customer_email.required' => 'Vui lòng nhập email',
            'customer_email.email' => 'Email không đúng định dạng',
            'customer_email.max' => 'Email không được vượt quá 255 ký tự',
            'variation_id.required' => 'Vui lòng chọn sản phẩm',
            'variation_id.*.required' => 'Vui lòng chọn sản phẩm',
            'variation_id.*.exists' => 'Sản phẩm không tồn tại',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.*.required' => 'Vui lòng nhập số lượng',
            'quantity.*.integer' => 'Số lượng phải là số nguyên',
            'quantity.*.min' => 'Số lượng phải lớn hơn 0'
        ];
    }
}
