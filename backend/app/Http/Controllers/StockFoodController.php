<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Stock;
use App\Models\StockFood;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStockFood;
use Illuminate\Support\Facades\DB;

class StockFoodController extends Controller
{
    public function index(int $id) {
        $stocks = Auth::user()->stocks()->get();

        $current_stock = Stock::find($id);

        $stock_foods = $current_stock->stock_foods()
                    ->leftJoin('foods', 'stock_foods.food_id', '=', 'foods.id')
                    ->select(['stock_foods.id as stock_food_id','food_id','count', 'register_date', 'name', 'volume', 'unit', 'protein', 'fat', 'carbohydrate'])
                    ->orderBy('food_id', 'asc')
                    ->paginate(5);

        return view('stock_foods/index',[
            'stocks' => $stocks,
            'current_stock_id' => $current_stock->id,
            'stock_foods' => $stock_foods,
        ]);
    }

    public function showCreateForm(int $id)
    {
        $today = date('Y-m-d');

        return view('stock_foods.create', [
            'foods' => DB::table('foods')
                    ->orderBy('category_id', 'asc')
                    ->get(),
            'today' => $today,
            'stock_id' => $id
        ]);
    }

    public function create(int $id, CreateStockFood $request)
    {
        $current_stock = Stock::find($id);

        $stock_food = new StockFood();
        $stock_food->food_id = $request->food_id;
        $stock_food->count = $request->count;
        $stock_food->register_date = $request->register_date;

        $current_stock->stock_foods()->save($stock_food);
        

        return redirect()->route('user.stock_foods.index',[
            'id'=>$current_stock->id,
        ]);
    }


    public function destroy(int $id, int $stock_food_id) {
        $current_stock = Stock::find($id);

        StockFood::where('id', $stock_food_id)->delete();

        return redirect()->route('user.stock_foods.index',[
            'id'=>$current_stock->id,
        ]);
    }

    public function gacha(int $id) {

        $current_stock = Stock::find($id);

        $weight_list = [
            '焼き肉' => 1,
            'ステーキ' => 4,
            'しゃぶしゃぶ'=>10,
            '回転寿司' => 15,
            '担々麺'=>20,
            'ラーメン' => 50,
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
        return redirect()->route('user.stock_foods.index',['id'=>$current_stock->id, $result]);
        
    }
}
