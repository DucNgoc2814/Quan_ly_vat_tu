<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'string',
                'regex:/^[\p{L}\s\-]+$/u',
                'min:10',
                'max:30',
            ],
            'email' => 'required|email|unique:employees,email,' . $this->route('id'),
            'number_phone' => [
                'required',
                'numeric',
                'regex:/^(0[1-9][0-9]{8})$/',
                Rule::unique('employees', 'number_phone')->ignore($this->route('id')),
            ],
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'cccd' => [
                'required',
                'regex:/^([0-9]{9}|[0-9]{12})$/',
                'unique:employees,cccd,' . $this->route('id')
            ],
            'date' => 'required|date|before_or_equal:' . now()->subYears(16)->toDateString() . '|after_or_equal:' . now()->subYears(55)->toDateString(),

        ];
    }
    public function messages(): array
    {
        return [
            'role_id.required' => 'Vui lòng chọn vị trí',
            'name.required' => 'Vui lòng nhập tên',
            'name.min' => 'Tên không hợp lệ',
            'name.max' => 'Tên không hợp lệ',
            'name.regex' => 'Vui lòng nhập tên hợp lệ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'number_phone.unique' => 'Không được trùng số điện thoại',
            'number_phone.required' => 'Không được bỏ trống số điện thoại',
            'number_phone.regex' => 'Số điện thoại không hợp lệ',
            'cccd.unique' => 'Căn cước công dân không được trùng',
            'cccd.regex' => 'Căn cước công dân không hợp lệ',
            'email.unique' => 'Email không được trùng',
            'image.image' => 'Hình ảnh không hợp lệ',
            'cccd.required' => 'Vui lòng nhập căn cước công dân',
            'date.required' => 'Vui lòng chọn ngày sinh',
            'date.before_or_equal' => 'Chưa đủ tuổi đi làm',
            'date.after_or_equal' => 'Đã quá tuổi đi làm',
        ];
    }
}
