<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelRequest extends FormRequest
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
            'file' => 'required|mimes:xls,xlsx'
        ];
    }
    public function messages()
    {
        return [
            'file.required' => 'Excel file needed.',
            'file.mimes' => 'Excel finds an invalid range operator in a formula.'
        ];
    }
}
