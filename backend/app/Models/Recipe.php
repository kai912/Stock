<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function foods()
    {
        return $this->belongsToMany('App\Models\Food', 'recipe_foods')->withPivot('count');
    }

    public function recipe_foods()
    {
        return $this->hasMany('App\Models\RecipeFood');
    }
}