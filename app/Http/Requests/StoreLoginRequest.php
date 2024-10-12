<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
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
        if (request()->isMethod('post') && request()->route()->getName() == 'client.handleLogin') {
            return [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ];
        } elseif (request()->isMethod('post') && request()->route()->getName() == 'client.sendMaill') {
            return [
                'email' => 'required|string|email|max:255',
            ];
        } elseif (request()->isMethod('post') && request()->route()->getName() == 'client.passwordchange') {
            return [
                'password' => 'required|string|min:6|confirmed',
            ];
        }
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'number_phone' => 'required|regex:/^(0[0-9]{9,10})$/|unique:customers',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên tài khoản',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được sử dụng',
            'number_phone.required' => 'Vui lòng nhập điện thoại',
            'number_phone.number_phone' => 'Số điện thoại không hợp lệ',
            'number_phone.unique' => 'Số điện thoại đã được sử dụng',
            'number_phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ];
    }
}
