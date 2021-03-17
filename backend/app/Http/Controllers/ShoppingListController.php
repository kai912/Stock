<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateShoppingList;
use App\Http\Requests\EditShoppingList;
use App\Models\Food;
use App\Models\User;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ShoppingListController extends Controller
{
    public function index()
    {
        $shopping_lists = Auth::user()
                ->shopping_lists()
                ->orderBy('shopping_lists.priority', 'desc')
                ->orderBy('shopping_lists.food_id', 'asc')
                ->get();

        return view('shopping_lists.index', [
            'shopping_lists'=> $shopping_lists, 
            ]);
    }

    public function showCreateForm()
    {
        $foods = DB::table('foods')
                ->orderBy('category_id', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        return view('shopping_lists.create', [
            'foods' => $foods,
            ]);
    }

    public function create(CreateShoppingList $request) {
        $shopping_list = new ShoppingList();

        $shopping_list->food_id = $request->food_id;
        $shopping_list->quantity = $request->quantity;
        $shopping_list->priority = $request->priority;
        $shopping_list->memo = $request->memo;

        Auth::user()->shopping_lists()->save($shopping_list);
        

        return redirect()->route('user.shopping_lists.index');
    }

    public function showEditForm(ShoppingList $shopping_list)
    {
        return view('shopping_lists.edit', [
            'shopping_list' => $shopping_list,
        ]);
    }

    public function edit(ShoppingList $shopping_list, EditShoppingList $request)
    {
        $shopping_list->quantity = $request->quantity;
        $shopping_list->priority = $request->priority;
        $shopping_list->memo = $request->memo;

        $shopping_list->save();

        return redirect()->route('user.shopping_lists.index');
    }

    public function destroy(ShoppingList $shopping_list) {

        $shopping_list->delete();

        return redirect()->route('user.shopping_lists.index');
    }
}
