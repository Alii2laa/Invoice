<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSection extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'section_name.required' => 'يرجى إدخال إسم القسم',
            'section_name.unique' => 'إسم القسم مسجل مسبقاً',
            'section_name.max' => 'يجب أن يقل عن 255 حرف',
            'description.required' => 'يرجى إدخال ملاحظات عن القسم'
        ];
    }
}
