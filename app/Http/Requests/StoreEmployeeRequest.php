<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'email' => 'required|email|unique:employees',
            'number_phone' => 'required|numeric|unique:employees',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'cccd' => 'required|digits_between:12,12|numeric|:employees|numeric',
            'date' => 'required|date',
            'description' => 'required',
            'password' => 'required|string|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'password.required'=>"Vui lòng nhập mật khẩu",
            'password.min'=>"Vui lòng nhập mật khẩu lớn hơn 6 ký tự",
            'role_id.required' => 'Vui lòng chọn vị trí',
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ !',
            'number_phone.unique' => 'Không được trùng số điện thoại',
            'number_phone.required' => 'Không được bỏ trống số điện thoại ',
            'number_phone.numeric' => 'Số điện thoại phải là số',
            'cccd.unique' => 'Căn cước công dân đã tồn tại',
            'cccd.min' => 'Căn cước công dân không hợp lệ',
            'cccd.max' => 'Căn cước công dân không hợp lệ',
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
