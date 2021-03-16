<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFood extends FormRequest
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
            'name' => 'required|max: 20',
            'volume' => 'required|integer',
            'unit' => 'required|max: 5',
            'protein' => 'numeric|regex:/\A\d{1,2}(\.\d{0,1})?\z/',
            'fat' => 'numeric|regex:/\A\d{1,2}(\.\d{0,1})?\z/',
            'carbohydrate' => 'numeric|regex:/\A\d{1,2}(\.\d{0,1})?\z/',
        ];
    }
    
}
