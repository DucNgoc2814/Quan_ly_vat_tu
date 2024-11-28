<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCargo_carRequest extends FormRequest
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
            'cargo_car_type_id' => 'required|exists:cargo_car_types,id',
            'license_plate' => 'required|string|between:9,10|regex:/^[A-Z0-9]+$/',
        ];
    }

    public function messages(){
        return [
            'cargo_car_type_id.required' => " Vui lòng chọn loại xe vận chuyển.",
            'cargo_car_type_id.exists' => "Loại xe vận chuyển không tồn tại.",
            'license_plate.required' => " Biển số xe không được bỏ trống",
            'license_plate.string' => "Biển số xe phải là kiểu chuỗi",
            'license_plate.between' => "Biển số xe phải có từ 9 đến 10 ký tự",
            'license_plate.regex' => "Biển số xe chỉ được chứa chữ cái và số",
        ];
    }
}
