<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContract_typeRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:contract_types,name',
            'description' => 'required|string|max:1000',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => "Tên loại hợp đồng bắt buộc điền",
            'name.string' => "Tên loại hợp đồng phải là chuỗi ký tự",
            'name.max' => "Tên loại hợp đồng không được dài quá 255 ký tự",
            'name.unique' => "Tên loại hợp đồng đã tồn tại",
            'description.required' => "Mô tả hợp đồng bắt buộc điền",
            'description.string' => "Mô tả hợp đồng phải là chuỗi ký tự",
            'description.max' => "Mô tả hợp đồng không được dài quá 1000 ký tự",
        ];
    }
}
