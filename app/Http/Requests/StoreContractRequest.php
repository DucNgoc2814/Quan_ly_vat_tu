<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
            'contract_number' => 'required|string|max:255|unique:contracts,contract_number',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'number_phone' => 'required|string|size:10',
            'total_amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:1000',
            'file' => 'required|file|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'contract_number.required' => 'Vui lòng nhập số hợp đồng',
            'contract_number.max' => 'Số hợp đồng không được vượt quá 255 ký tự',
            'contract_number.unique' => 'Số hợp đồng đã tồn tại, vui lòng nhập số khác.',
            'customer_name.required' => 'Vui lòng nhập tên khách hàng',
            'customer_name.max' => 'Tên khách hàng không được vượt quá 255 ký tự',
            'customer_email.required' => 'Vui lòng nhập email khách hàng',
            'customer_email.email' => 'Email khách hàng không đúng định dạng',
            'customer_email.max' => 'Email khách hàng không được vượt quá 255 ký tự',
            'number_phone.required' => 'Vui lòng nhập số điện thoại khách hàng',
            'number_phone.string' => 'Số điện thoại khách hàng phải là chuỗi',
            'number_phone.size' => 'Số điện thoại khách hàng phải có đúng 10 ký tự',
            'total_amount.required' => 'Vui lòng nhập tổng số tiền hợp đồng',
            'total_amount.numeric' => 'Tổng số tiền hợp đồng phải là số',
            'total_amount.min' => 'Tổng số tiền hợp đồng phải lớn hơn 0',
            'note.max' => 'Mô tả không được vượt quá 1000 ký tự',
            'file.required' => 'Vui lòng tải lên file hợp đồng',
            'file.mimes' => 'File phải có định dạng PDF',
            'file.max' => 'Kích thước file không được vượt quá 2MB',
        ];
    }
}
