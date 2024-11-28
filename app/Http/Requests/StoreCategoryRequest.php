<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100|unique:categories,name|regex:/^(?![0-9]+$).*/',
            'image' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.string' => 'Tên danh mục phải là chuỗi ký tự',
            'name.min' => 'Tên danh mục phải có ít nhất 3 ký tự',
            'name.max' => 'Tên danh mục không được vượt quá 100 ký tự',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'name.regex' => 'Tên danh mục không được chỉ chứa số',
            'image.required' => 'Ảnh không được bỏ trống',
            'image.image' => 'Tệp tải lên phải là hình ảnh',
        ];
    }
}
