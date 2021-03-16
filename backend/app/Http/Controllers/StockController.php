<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStock;

class StockController extends Controller
{
    public function showCreateForm()
    {
        return view('stocks/create');
    }

    public function create(CreateStock $request)
    {
        $stock = new Stock();

        $stock->name = $request->name;

        Auth::user()->stocks()->save($stock);

        return redirect()->route('user.stock_foods.index', [
            'id' => $stock->id,
        ]);
    }
}
