<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Stock;
use App\Models\StockFood;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStockFood;
use App\Http\Requests\EditStockFood;
use Illuminate\Support\Facades\DB;

class StockFoodController extends Controller
{
    public function index(Stock $stock) 
    {
        $stocks = Auth::user()->stocks()->get();

        $stock_foods = $stock->stock_foods()
                    ->leftJoin('foods', 'stock_foods.food_id', '=', 'foods.id')
                    ->select(['stock_foods.id', 'stock_id', 'food_id', 'count', 'register_date', 'name', 'volume', 'unit', 'protein', 'fat', 'carbohydrate'])
                    ->orderBy('food_id', 'asc')
                    ->get();

        return view('stock_foods/index',[
            'stocks' => $stocks,
            'stock' => $stock,
            'stock_foods' => $stock_foods,
            'current_stock_id' => $stock->id
        ]);
    }

    public function showCreateForm(Stock $stock)
    {
        $today = date('Y-m-d');

        return view('stock_foods.create', [
            'foods' => DB::table('foods')
                    ->orderBy('category_id', 'asc')
                    ->orderBy('id', 'asc')
                    ->get(),
            'today' => $today,
            'stock' => $stock
        ]);
    }

    public function create(Stock $stock, CreateStockFood $request)
    {
        $stock_food = new StockFood();
        $stock_food->food_id = $request->food_id;
        $stock_food->count = $request->count;
        $stock_food->register_date = $request->register_date;

        $stock->stock_foods()->save($stock_food);

        return redirect()->route('user.stock_foods.index',[
            'stock'=>$stock,
        ]);
    }


    public function destroy(Stock $stock, StockFood $stock_food) 
    {
        $this->checkRelation($stock, $stock_food);

        $stock_food->delete();

        return redirect()->route('user.stock_foods.index',[
            'stock'=>$stock,
        ]);
    }

    public function showEditForm(Stock $stock, StockFood $stock_food)
    {
        $this->checkRelation($stock, $stock_food);

        $stocks = Auth::user()->stocks()->get();

        return view('stock_foods/edit', [
            'stock_food' => $stock_food,
            'stock' => $stock,
            'stocks' => $stocks,
        ]);
    }

    public function edit(Stock $stock, StockFood $stock_food, EditStockFood $request)
    {
        $this->checkRelation($stock, $stock_food);

        if($stock_food->count <= $request->count) {
            $stock_food->stock_id = $request->stock_id;
            $stock_food->count = $request->count;
            $stock_food->register_date = $request->register_date;

            $stock_food->save();
        } else {
            $count = $stock_food->count - $request->count;

            $stock_food->stock_id = $request->stock_id;
            $stock_food->count = $request->count;
            $stock_food->register_date = $request->register_date;

            $stock_food->save();

            $stock_food = new StockFood();

            $stock_food->food_id = $request->food_id;
            $stock_food->stock_id = $stock->id;
            $stock_food->count = $count;
            $stock_food->register_date = $request->register_date;

            $stock_food->save();
        }
        return redirect()->route('user.stock_foods.index', [
            'stock' =>$stock,
            'stock_food' => $stock_food,
        ]);
    }

    private function checkRelation(Stock $stock, StockFood $stock_food)
    {
        if ($stock->id !== $stock_food->stock_id) {
            abort(404);
        }
    }

    public function gacha(Stock $stock) 
    {
        $weight_list = [
            '焼き肉' => 1,
            'ステーキ' => 4,
            'しゃぶしゃぶ'=>10,
            '回転寿司' => 15,
            '担々麺'=>20,
            'カレー' => 50,
        ];
        
        $result_number = mt_rand(1, array_sum($weight_list));
        
        $total_weight = 0;
        foreach ($weight_list as $name => $weight)
        {
            $total_weight += $weight;
            if ($result_number <= $total_weight)
            {
                $result = $name;
                break;
            }
        }
        return redirect()->route('user.stock_foods.index',['stock'=>$stock, $result]);
        
    }
}
