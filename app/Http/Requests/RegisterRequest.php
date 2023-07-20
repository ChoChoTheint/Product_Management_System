<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'item_code' => 'required',
            'item_name' => 'required',
            'category_id' => 'required',
            'stock' => 'required|integer',
            'date' => 'required|date',
            'file'  =>  'mimes:jpeg,jpg,png'
        ];
    }
    public function messages()
    {
        return [
            'item_code.required' => 'Item Code is required.',
            'item_name.required' => 'Item Name is required',
            'category_id.required' => 'Choose one category.',
            'stock.required' => 'Item stock is required.',
            'date.required' => 'Received date is required.',
            'file.mimes' => 'The image type must be jpeg, jpg and png.'
        ];
    }
}
