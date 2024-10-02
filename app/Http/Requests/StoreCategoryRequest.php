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
            'name' => 'required|string',
            'sku' => 'required|string',
            'image' => 'required|Image',
            'description' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Không dược bỏ trống',
            'sku.required' => 'Không dược bỏ trống',
            'image.required' => 'Không được bỏ trống',
            'description.required' => 'Không dược bỏ trống',
        ];
    }
}
