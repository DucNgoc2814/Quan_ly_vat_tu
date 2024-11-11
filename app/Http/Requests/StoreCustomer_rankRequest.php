<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer_rankRequest extends FormRequest
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
            'name' => 'required|unique:customer_ranks,name',
            'discount' => 'required|numeric|gt:0.5',
            'amount' => 'required|numeric|min:1',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên hạng khách hàng là bắt buộc.',
            'name.unique' => 'Tên hạng khách hàng đã tồn tại.',
            'discount.required' => 'Giảm giá là bắt buộc.',
            'discount.numeric' => 'Giảm giá phải là một số.',
            'discount.gt' => 'Giảm giá phải lớn hơn 0.5',
            'amount.required' => 'Số lượng là bắt buộc.',
            'amount.numeric' => 'Số lượng phải là một số.',
            'amount.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',

        ];
    }
}

