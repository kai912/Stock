<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeFood extends Model
{
    protected $table = 'recipe_foods';

    public function food()
    {
        return $this->belongsTo('App\Models\Food');
    }

    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe');
    }
}