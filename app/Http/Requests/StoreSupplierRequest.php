<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'number_phone' => 'required|numeric|unique:suppliers,number_phone',
            'address' => 'required',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được bỏ trống !',
            'email.required' => 'Không được bỏ trống !',
            'email.email' => 'Không đúng định dạng !',
            'email.unique' => 'Không được trung email nhà cung cấp !',
            'number_phone.required' => 'Không được bỏ trống !',
            'number_phone.unique' => 'Không được trùng số điện thoại !',
            'number_phone.numeric' => 'Số điện thoại không đúng định dạng bắt buộc phải là số !',
            'address.required' => 'Không được bỏ trống !',
        ];
    }
}
