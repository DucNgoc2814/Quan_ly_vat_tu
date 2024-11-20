<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'number_phone' => 'required|regex:/^(0[0-9]{9,10})$/|unique:customers,number_phone,' . $this->customer_id,
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'payment_id' => 'required|exists:payments,id',
            'variation_id' => 'required|array',
            'variation_id.*' => 'exists:variations,id',
            'product_quantity' => 'required|array',
            'product_quantity.*' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    if (!is_numeric($value)) {
                        return;  // Skip stock validation if value is not numeric
                    }
                    $index = explode('.', $attribute)[1];
                    $variationId = $this->input('variation_id')[$index];
                    $variation = \App\Models\Variation::find($variationId);
                    if ($variation && $value > $variation->stock) {
                        $fail("Số lượng sản phẩm không được lớn hơn số lượng có trong kho ({$variation->stock}).");
                    }
                },
            ],
            'paid_amount' => 'nullable|numeric|min:0|lte:total_amount',
        ];
    }
    public function messages()
    {
        return [
            'customer_id.required' => 'Vui lòng chọn khách hàng.',
            'customer_id.exists' => 'Khách hàng không tồn tại.',
            'customer_name.required' => 'Vui lòng nhập tên khách hàng.',
            'customer_name.string' => 'Tên khách hàng phải là chuỗi ký tự.',
            'customer_name.max' => 'Tên khách hàng không được vượt quá 255 ký tự.',
            'number_phone.required' => 'Vui lòng nhập số điện thoại.',
            'number_phone.regex' => 'Số điện thoại không hợp lệ.',
            'number_phone.unique' => 'Số điện thoại đã được sử dụng.',

            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',

            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'payment_id.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment_id.exists' => 'Phương thức thanh toán không tồn tại.',

            'variation_id.required' => 'Vui lòng chọn ít nhất một sản phẩm.',
            'variation_id.array' => 'Dữ liệu sản phẩm không hợp lệ.',
            'variation_id.*.exists' => 'Sản phẩm không tồn tại.',

            'product_quantity.required' => 'Vui lòng nhập số lượng cho mỗi sản phẩm.',
            'product_quantity.*.required' => 'Vui lòng nhập số lượng sản phẩm.',
            'product_quantity.array' => 'Dữ liệu số lượng sản phẩm không hợp lệ.',
            'product_quantity.*.integer' => 'Số lượng phải là số nguyên.',
            'product_quantity.*.min' => 'Số lượng phải lớn hơn 0.',

            'paid_amount.numeric' => 'Số tiền đã trả phải là số.',
            'paid_amount.min' => 'Số tiền đã trả không được âm.',
            'paid_amount.lte' => 'Số tiền đã trả không được lớn hơn tổng giá trị đơn hàng.',
        ];
    }
}
