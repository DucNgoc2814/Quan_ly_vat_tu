<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'url' => 'image|mimes:jpg,png,gif|max:2048',
            'description' => 'nullable|string|regex:/^(?=.*[a-zA-Z]).*$/',
            'date_start' => 'required|date|after_or_equal:today|before_or_equal:date_end',
            'date_end' => 'required|date|after_or_equal:date_start',
            'status' => 'required|in:1,0',
        ];
    }
    public function messages(){
         return[
            'url.image' => 'File định dạng  Ảnh không đúng. ',
            'url.mimes' => 'Ảnh phải có định dạng là jpg, png, gif. ',
            'url.max' => 'Ảnh không được có dung lượng lớn hơn 2MB. ',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'description.regex' => 'Mô tả không được chỉ chứa số.',
            'date_start.required' => 'Vui lòng nhập ngày bắt đầu.',
            'date_start.after_or_equal' => 'Ngày bắt đầu phải là hôm nay hoặc ngày trong tương lai.',
            'date_start.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc.',
            'date_end.required' => 'Vui lòng nhập ngày kết thúc.',
            'date_end.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'status.required'=> 'Vui lòng chọn trạng thái.',
            'status.in'=> 'Trạng thái phải là "Hiển thị" hoặc "Ẩn".',

         ];
    }
}
