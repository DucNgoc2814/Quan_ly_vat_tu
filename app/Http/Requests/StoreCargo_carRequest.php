<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCargo_carRequest extends FormRequest
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
            'license_plate' => 'required|string|max:20|unique:cargo_cars,license_plate',
            'is_active'=> 'required|in:0,1',
        ];
    }

    public function messages(){
        return [
            'cargo_car_type_id.required' => " Vui lòng chọn loại xe chở hàng.",
            'cargo_car_type_id.exits' => "Loại xe chở hàng không tồn tại.",
            'license_plate.required' => " Biển số xe không được bỏ trống",
            'license_plate.string' => "Biển số xe phải là kiểu chuỗi",
            'license_plate.max' => "Biển số xe không được quá 20 ký tự",
            'license_plate.unique' => "Biển số xe đã tồn tại",
            'is_active.required'=> "vui lòng chọn trạng thái",
            'is_active.in'=> "Trạng thái không hợp lệ",


        ];
    }
}
