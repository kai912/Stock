<?php

namespace App\Http\Requests;

use App\Models\StockFood;
use Illuminate\Validation\Rule;

class EditStockFood extends CreateStockFood
{
    
    public function rules()
    {
        $rule = parent::rules();

        return $rule;
    }

    
}
