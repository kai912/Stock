<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFood;

use App\Http\Requests\EditFood;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function index(int $id)
    {
        $categories = Auth::user()->categories()->get();

        $current_category = category::find($id);

        $foods = $current_category->foods()->paginate(15);

        return view('foods/index',[
            'categories' => $categories,
            'current_category_id' => $current_category->id,
            'foods' => $foods,
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('foods/create', [
            'category_id' => $id
        ]);
    }

    public function create(int $id, CreateFood $request)
    {
        $current_category = category::find($id);
        
        $food = new Food();
        $food->name = $request->name;
        $food->volume = $request->volume;
        $food->unit = $request->unit;
        $food->protein = $request->protein;
        $food->fat = $request->fat;
        $food->carbohydrate = $request->carbohydrate;

        $current_category->foods()->save($food);

        return redirect()->route('admin.foods.index', [
            'id' => $current_category->id,
        ]);
    }

    public function showEditForm(int $id, int $food_id)
    {
        $food = Food::find($food_id);

        return view('foods.edit', [
            'food' => $food,
        ]);
    }

    public function edit(int $id, int $food_id, EditFood $request)
    {
        
        $food = Food::find($food_id);

        $food->name = $request->name;
        $food->volume = $request->volume;
        $food->unit = $request->unit;
        $food->protein = $request->protein;
        $food->fat = $request->fat;
        $food->carbohydrate = $request->carbohydrate;

        $food->save();

        return redirect()->route('admin.foods.index', [
            'id' => $food->category_id,
        ]);
    }
}