<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


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


    public function update($id, Request $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        if($request->has('parent_id')){
            $category->parent_id = $request->parent_id;
        }
        $category->save();

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $payment_link = Category::findOrFail($id);
        $payment_link->delete();

        Alert::success('Success', 'Category deleted.');

        return redirect()->route('payment-links.index');
    }


}
