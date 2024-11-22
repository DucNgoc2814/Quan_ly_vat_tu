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
            'name' => 'required|unique:categories,name',
            'image' => 'required|Image',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không dược bỏ trống',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'image.required' => 'Ảnh không được bỏ trống',
        ];
    }
}
