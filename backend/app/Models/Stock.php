<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Stock extends Model
{
    public function stock_foods()
    {
        return $this->hasMany('App\Models\StockFood');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
