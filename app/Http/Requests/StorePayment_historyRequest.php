<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayment_historyRequest extends FormRequest
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
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date|before_or_equal:today',
            'note' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // Max 2MB
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'Vui lòng nhập số tiền',
            'amount.numeric' => 'Số tiền phải là số',
            'amount.min' => 'Số tiền phải lớn hơn 0',
            
            'payment_date.required' => 'Vui lòng chọn ngày thanh toán',
            'payment_date.date' => 'Ngày thanh toán không hợp lệ',
            'payment_date.before_or_equal' => 'Ngày thanh toán không được lớn hơn ngày hiện tại',
            
            'note.required' => 'Vui lòng nhập nội dung thanh toán',
            'note.string' => 'Nội dung thanh toán không hợp lệ',
            'note.max' => 'Nội dung thanh toán không được vượt quá 255 ký tự',
            
            'document.file' => 'File không hợp lệ',
            'document.mimes' => 'File phải có định dạng: pdf, jpg, jpeg, png',
            'document.max' => 'File không được vượt quá 2MB',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'amount' => 'Số tiền',
            'payment_date' => 'Ngày thanh toán',
            'note' => 'Nội dung thanh toán',
            'document' => 'Chứng từ',
        ];
    }
}
