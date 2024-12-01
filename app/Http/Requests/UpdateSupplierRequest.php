<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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


            'name' => 'required|string|min:3|max:100|regex:/^[a-zA-Z\s]+$/|unique:suppliers,name,' . $this->route('id'),
            'email' => 'required|email|unique:suppliers,email,' . $this->route('id'),
            'number_phone' => 'required|regex:/^0[1-9]{1}[0-9]{8}$/|unique:suppliers,number_phone,' . $this->route('id'),
            'address' => 'required|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được bỏ trống !',
            'name.unique' => 'Không được trùng tên nhà cung cấp !',
            'name.regex' => 'Vui lòng nhập chuỗi kí tự !',
            'name.min' => 'Nhập tối thiểu 3 kí tự !',
            'name.max' => 'Vượt quá 100 kí tự !',
            'email.required' => 'Không được bỏ trống !',
            'email.email' => 'Không đúng định dạng !',
            'email.unique' => 'Không được trung email nhà cung cấp !',
            'number_phone.required' => 'Không được bỏ trống !',
            'number_phone.unique' => 'Không được trùng số điện thoại !',
            'number_phone.numeric' => 'Số điện thoại không đúng định dạng bắt buộc phải là số !',
            'address.required' => 'Không được bỏ trống !',
            'address.regex' => 'Nhập đúng định dạng!',
        ];
    }
}
