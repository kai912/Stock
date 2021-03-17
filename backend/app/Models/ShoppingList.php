<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $table = 'shopping_lists';

    public function food()
    {
        return $this->belongsTo('App\Models\Food');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
