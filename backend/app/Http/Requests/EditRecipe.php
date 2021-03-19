<?php

namespace App\Http\Requests;

use App\Models\Recipe;
use Illuminate\Validation\Rule;

class EditRecipe extends CreateRecipe
{
    
    public function rules()
    {
        $rule = parent::rules();

        return $rule;
    }
}
