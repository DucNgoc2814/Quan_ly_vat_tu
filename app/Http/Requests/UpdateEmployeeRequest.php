<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'role_id' => 'required',
            'name' => 'required|String',
            'email' => 'required|email|unique:employees,email,' . $this->route('id'),
            'number_phone' => 'required|numeric|unique:employees,number_phone,' . $this->route('id'),
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'cccd' => 'required|digits_between:12,12|numeric|unique:employees,cccd,' . $this->route('id'),
            'date' => 'required|date',
            'description' => 'required',


        ];
    }
    public function messages(): array
    {
        return [
            'role_id.required' => 'Vui lòng chọn vị trí',
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'number_phone.unique' => 'Không được trùng số điện thoại',
            'number_phone.required' => 'Không được bỏ trống số điện thoại',
            'number_phone.numeric' => 'Số điện thoại phải là số',
            'cccd.unique' => 'Căn cước công dân không được trùng',
        
            'cccd.digits_between' => 'Căn cước công dân không hợp lệ',

            'cccd.numeric' => 'Căn cước công dân không hợp lệ',
            'email.unique' => 'Email không được trùng',
            // 'image.required' => 'Vui lòng chọn hình ảnh',
            'image.image' => 'Hình ảnh không hợp lệ',
            'cccd.required' => 'Vui lòng nhập căn cước công dân',
            'date.required' => 'Vui lòng chọn ngày sinh',
            'description.required' => 'Vui lòng nhập mô tả',


        ];
    }
}
