<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRecipe;
use App\Http\Requests\EditRecipe;
use App\Models\Food;
use App\Models\Recipe;
use App\Models\RecipeFood;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();

        return view('recipes.index', [
            'recipes'=> $recipes, 
            ]);
    }

    public function showCreateForm()
    {
        $foods = DB::table('foods')
                ->orderBy('category_id', 'asc')
                ->orderBy('id', 'asc')
                ->get();

        return view('recipes.create', [
            'foods' => $foods,
            ]);
    }

    public function create(CreateRecipe $request) {
        $recipe = new Recipe();

        $recipe->name = $request->name;
        $recipe->save();
        
        /**食材登録の種類の最大値５に設定 */
        for($i = 0;$i < 5; $i++) {
            $current_food_id = 'food_id' . $i;
            $current_count = 'count' . $i;

            if($request->$current_count > 0) {

                $recipe_food = new RecipeFood();
                $recipe_food->recipe_id = $recipe->id;
                $recipe_food->food_id = $request->$current_food_id;
                $recipe_food->count = $request->$current_count;

                $recipe_food->save();
            } else {
                break;
            }
        }

        return redirect()->route('user.recipes.index');
    }

    public function showEditForm(Recipe $recipe)
    {
        $foods = DB::table('foods')
                ->orderBy('category_id', 'asc')
                ->orderBy('id', 'asc')
                ->get();

        return view('recipes.edit', [
            'recipe' => $recipe,
            'foods' => $foods,
        ]);
    }

    public function edit(Recipe $recipe, EditRecipe $request)
    {
        $recipe->name = $request->name;
        $recipe->save();

        $recipe_foods = $recipe->recipe_foods();

        foreach($recipe_foods as $recipe_food) {
            $id = $recipe_food->id;
            $current_food_id = 'food_id' . $id;
            $current_count = 'count' . $id;

            $recipe_food->food_id = $request->$current_food_id;
            $recipe_food->count = $request->$current_count;

            $recipe_food->save();
        }

        return redirect()->route('user.recipes.index');
    }

    public function destroy(Recipe $recipe) {

        $recipe->recipe_foods()->delete();
        $recipe->delete();

        return redirect()->route('user.recipes.index');
    }
    
}
