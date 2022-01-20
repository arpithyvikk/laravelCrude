<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function show()
    {
        $categories = Category::paginate(5);
        return view('category',['categories'=>$categories]);
    }

    public function insert(Request $request)
    {

        $validator =  $request->validate([
            'category_name' => 'required|unique:categories',
            'status' => 'required',
            'user_id' => 'required',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $category->user_id = $request->user_id;
        $category->save();

        session()->flash('success_message','Category Added.');
        return redirect('/category');
    }
}
