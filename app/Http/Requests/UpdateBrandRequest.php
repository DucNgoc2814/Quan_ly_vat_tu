<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100|unique:brands,name,' . $this->route('brand')->id . '|regex:/^(?![0-9]+$).*/',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Custom validation error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên thương hiệu',
            'name.string' => 'Tên thương hiệu phải là chuỗi ký tự',
            'name.min' => 'Tên thương hiệu phải có ít nhất 3 ký tự',
            'name.max' => 'Tên thương hiệu không được vượt quá 100 ký tự',
            'name.unique' => 'Tên thương hiệu đã tồn tại',
            'name.regex' => 'Tên thương hiệu không được chỉ chứa số',
        ];
    }
}
