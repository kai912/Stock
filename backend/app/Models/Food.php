<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Food extends Model
{
    protected $table = 'foods';

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m/d');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m/d');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function stock_foods()
    {
        return $this->hasMany('App\Models\StockFood');
    }

    public function recipes()
    {
        return $this->belongsToMany('App\Models\Recipe','recipe_foods')->withPivot('count');
    }

    public function recipe_foods()
    {
        return $this->hasMany('App\Models\RecipeFood');
    }

}
