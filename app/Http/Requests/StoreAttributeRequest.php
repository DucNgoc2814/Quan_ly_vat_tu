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
            'name' => 'required|string|max:255|unique:attributes,name',
            'values' => 'required|array',
            'values.*' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên loại biến thể không được để trống',
            'name.unique' => 'Tên loại biến thể đã tồn tại',
            'name.max' => 'Tên loại biến thể không được vượt quá 255 ký tự',
            'values.required' => 'Giá trị biến thể không được để trống',
            'values.*.required' => 'Giá trị biến thể không được để trống',
            'values.*.max' => 'Giá trị biến thể không được vượt quá 255 ký tự'
        ];
    }
}
