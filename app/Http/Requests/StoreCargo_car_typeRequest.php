<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCargo_car_typeRequest extends FormRequest
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
            'cargo_car_type_id' => 'required|exists:cargo_car_types,id',
          'license_plate' => 'required|string|max:20|unique:cargo_cars,license_plate',
          'is_active'=> 'required|in:0,1',
        ];
    }
    
}
