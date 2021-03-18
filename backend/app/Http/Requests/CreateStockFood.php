<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStockFood extends FormRequest
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
            'food_id' => 'required',
            'count' => 'numeric|regex:/\A\d{1,4}(\.\d{0,2})?\z/',
            'register_date' => 'required|date|before_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'count' => '数量',
            'register_date' => '登録日'
        ];
    }
}
