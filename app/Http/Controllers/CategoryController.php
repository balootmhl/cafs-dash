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

        $title = 'Delete Event Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('categories.index', compact('categories'));
    }

    public function getSubcategories($mainCategoryId)
    {
        // Fetch subcategories based on the selected main category
        $subcategories = Category::where('parent_id', $mainCategoryId)->get();

        return response()->json($subcategories);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        if($request->has('parent_id')){
            $category->parent_id = $request->parent_id;
        }
        $category->save();

        Alert::success('Success', 'Category created.');

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
        $category = Category::findOrFail($id);
        $category->delete();

        Alert::success('Success', 'Category deleted.');

        return redirect()->route('categories.index');
    }


}
