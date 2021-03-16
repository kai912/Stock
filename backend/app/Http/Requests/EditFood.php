<?php

namespace App\Http\Requests;

use App\Models\Food;
use Illuminate\Validation\Rule;

class EditFood extends CreateFood
{
    
    public function rules()
    {
        $rule = parent::rules();

        return $rule;
    }

    
}
