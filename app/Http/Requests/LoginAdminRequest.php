<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'password.required'=>"Vui lòng nhập mật khẩu",
            'password.min'=>"Vui lòng nhập mật khẩu lớn hơn 6 ký tự",
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ !',
        ];
    }
}
