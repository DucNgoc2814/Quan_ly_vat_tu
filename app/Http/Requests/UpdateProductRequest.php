<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product');
        return [
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'brand_id' => 'nullable|exists:brands,id',
            'slug' => 'required|string|max:255|unique:products,slug,' . $productId,
            'name' => 'required|string|max:255|unique:products,name,' . $productId,
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ];
    }
}
