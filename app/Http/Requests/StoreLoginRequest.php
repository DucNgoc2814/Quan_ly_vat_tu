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
        if (request()->isMethod('post') && request()->route()->getName() == 'handleLogin') {
            return [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ];
        } elseif (request()->isMethod('post') && request()->route()->getName() == 'sendMaill') {
            return [
                'email' => 'required|string|email|max:255',
            ];
        } elseif (request()->isMethod('post') && request()->route()->getName() == 'passwordchange') {
            return [
                'password' => 'required|string|min:6|confirmed',
            ];
        } elseif (request()->isMethod('post') && request()->route()->getName() == 'passwordUser') {
            return [
                'old_password' => 'required',
                'new_password' => 'required|min:6|different:old_password',
                'confirm_password' => 'required|same:new_password',
            ];
        } elseif (request()->isMethod('post') && request()->route()->getName() == 'updateProfile') {
            return [
                'name' => 'required|string|regex:/^(?=.*[a-zA-Z]).*$/|max:5555',
                'email' => 'required|string|email|max:255|unique:customers',
                'number_phone' => 'required|regex:/^(0[0-9]{9,10})$/|unique:customers',
            ];
        }
        return [
            'name' => 'required|string|regex:/^(?=.*[a-zA-Z]).*$/|max:5555',
            'email' => 'required|string|email|max:255|unique:customers',
            'number_phone' => 'required|regex:/^(0[0-9]{9,10})$/|unique:customers',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên tài khoản',
            'name.regex' => 'Tên tài khoản không được chỉ chứa mỗi số.',
            'name.max' => 'Tên tài khoản không được quá 55 ký tự.',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được sử dụng',
            'number_phone.required' => 'Vui lòng nhập điện thoại',
            'number_phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số',
            'number_phone.unique' => 'Số điện thoại đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'old_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'new_password.different' => 'Mật khẩu mới phải khác mật khẩu hiện tại',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu mới',
            'confirm_password.same' => 'Xác nhận mật khẩu không khớp với mật khẩu mới',
        ];
    }
}
