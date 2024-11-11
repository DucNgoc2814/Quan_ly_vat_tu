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
            'name' => 'required|string|max:255',
            'order_id' => 'required|not_in:0|exists:orders,id',
            'contract_type_id' => 'required|not_in:0|exists:contract_types,id',
            'note' => 'nullable|string|max:1000',
            'file' => 'required|file|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên hợp đồng',
            'name.max' => 'Tên hợp đồng không được vượt quá 255 ký tự',
            'order_id.required' => 'Vui lòng chọn đơn hàng',
            'order_id.not_in' => 'Vui lòng chọn đơn hàng',
            'order_id.exists' => 'Đơn hàng không tồn tại trong hệ thống',
            'contract_type_id.required' => 'Vui lòng chọn loại hợp đồng',
            'contract_type_id.not_in' => 'Vui lòng chọn loại hợp đồng',
            'contract_type_id.exists' => 'Loại hợp đồng không tồn tại trong hệ thống',
            'note.max' => 'Mô tả không được vượt quá 1000 ký tự',
            'file.required' => 'Vui lòng tải lên file hợp đồng',
            'file.mimes' => 'File phải có định dạng PDF',
            'file.max' => 'Kích thước file không được vượt quá 2MB',
        ];
    }
}
