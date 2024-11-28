<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:55|unique:attributes,name|regex:/^(?![0-9]+$).*/',
            'values' => 'required|array',
            'values.*' => 'required|string|min:3|max:55|unique:attributes,name|regex:/^(?![0-9]+$).*/',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên loại biến thể không được để trống',
            'name.unique' => 'Tên loại biến thể đã tồn tại',
            'name.min' => 'Tên loại biến thể phải có ít nhất 3 ký tự',
            'name.max' => 'Tên loại biến thể không được vượt quá 55 ký tự',
            'name.regex' => 'Tên loại biến thể không được chỉ chứa số',
            'values.required' => 'Giá trị biến thể không được để trống',
            'values.*.required' => 'Giá trị biến thể không được để trống',
            'values.*.min' => 'Giá trị biến thể có ít nhất 3 ký tự',
            'values.*.max' => 'Giá trị biến thể không được vượt quá 55 ký tự',
            'values.*.regex' => 'Giá trị biến thể không được chỉ chứa số',

        ];
    }
}
