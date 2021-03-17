<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function index()
    {
        $user = Auth::user();

        $stock = $user->stocks()->first();

        if(is_null($stock)) {
            return view('user.dashboard');
        }

        return redirect()->route('user.stock_foods.index', [
            'stock' => $stock,
        ]);
    }
}
