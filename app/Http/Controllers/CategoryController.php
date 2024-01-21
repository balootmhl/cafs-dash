<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        if($request->has('parent_id')){
            $category->parent_id = $request->parent_id;
        }
        $category->save();

        return redirect()->route('categories.index');
    }

}
