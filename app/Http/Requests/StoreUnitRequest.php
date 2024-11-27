<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            //
            'name' => "required|string|regex:/^[a-zA-Z\s]+$/|max:55|unique:units,name"
        ];
    }
    public function messages(): array
    {
        return[
            'name.required' => "Tên đơn vị không được bỏ trống. ",
            'name.string' => "Tên đơn vị phải là chuỗi ký tự. ",
            'name.regex' => "Tên đơn vị không được chứa ký tự đặc biệt hoặc số.",
            'name.max' => "Tên đơn vị phải nhỏ hơn 55 ký tự. ",
            'name.unique' => "Tên đơn vị đã tồn tại. ",

        ];
    }
}
