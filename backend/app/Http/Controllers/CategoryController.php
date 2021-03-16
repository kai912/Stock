<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CreateCategory;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function showCreateForm()
    {
        return view('categories/create');
    }

    public function create(CreateCategory $request)
    {
        $category = new Category();

        $category->name = $request->name;

        Auth::user()->categories()->save($category);

        return redirect()->route('admin.foods.index', [
            'id' => $category->id,
        ]);
    }
}
