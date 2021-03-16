<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StockFood extends Model
{
    protected $table = 'stock_foods';

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m/d');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m/d');
    }

    protected $dates = [
        'register_date', 
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function food()
    {
        return $this->belongsTo('App\Models\Food');
    }

    public function stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }
}
