<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
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
    public function rules()
    {
        return [
            'cargo_car_id' => 'required|exists:cargo_cars,id',
            'employee_id' => 'required|exists:employees,id',
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'total_amount' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'cargo_car_id.required' => 'Vui lòng chọn phương tiện vận chuyển.',
            'employee_id.required' => 'Vui lòng chọn tài xế.',
            'order_ids.required' => 'Vui lòng chọn ít nhất một đơn hàng.',
            'order_ids.array' => 'Danh sách đơn hàng không hợp lệ.',
        ];
    }
}
