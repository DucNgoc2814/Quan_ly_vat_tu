<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImport_orderRequest extends FormRequest
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
            // 'status_id' => 'required',
            'product_quantity' => 'required',
            'total_amount' => 'required',
            'paid_amount' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'payment_id.required' => 'Vui lòng chọn',
            'supplier_id.required' => 'Vui lòng chọn',
            'variation_id.required' => 'Vui lòng',
            'product_quantity.required' => 'Vui lòng nhập số lượng',
        ];
    }
}
