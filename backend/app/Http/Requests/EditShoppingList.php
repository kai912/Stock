<?php

namespace App\Http\Requests;

use App\Models\ShoppingList;
use Illuminate\Validation\Rule;

class EditShoppingList extends CreateShoppingList
{
    
    public function rules()
    {
        $rule = parent::rules();

        return $rule;
    }
}