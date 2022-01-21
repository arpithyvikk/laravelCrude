<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function show(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != ""){
            $categories = Category::where('category_name', 'LIKE', "%$search%")->orWhere('status', 'LIKE', "%$search%")->orWhere('user_id', 'LIKE', "%$search%")->paginate();
        }
        else{
            $categories = Category::paginate(5);
        }
        
        return view('category',['categories'=>$categories, 'search'=>$search]);
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

        session()->flash('success_message','Category Added..');
        return redirect('/category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if(is_null($category)){
            return view('category');
        }
        else{

            $category = compact('category');
            return view('edit_category')->with($category);
        }
        // return view('category.edit', compact('categories'));
    }

    public function update(Request $request)
    {
        $validator =  $request->validate([
            'category_name' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'id' => 'required',
        ]);
        $id = $request['id'];
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $category->user_id = $request->user_id;
        $category->save();

        session()->flash('success_message','Category Updated..');
        return redirect('/category');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if(!is_null($category)){
            $category->delete();
            session()->flash('success_message','Category Moved to Trash..');
        }
        return redirect('/category');    
    }

    public function trash(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != ""){
            // $categories = Category::where('category_name', 'LIKE', "%$search%")->orWhere('status', 'LIKE', "%$search%")->orWhere('user_id', 'LIKE', "%$search%")->onlyTrashed()->toSql();
            $categories = Category::where(function ($query) use($search) {
                $query->where('category_name', 'LIKE', "%$search%")->orWhere('status', 'LIKE', "%$search%")->orWhere('user_id', 'LIKE', "%$search%");
           })->onlyTrashed()->paginate();
            // dd($categories);        
        }
        else{
            $categories = Category::onlyTrashed()->paginate(5);
        }
        return view('category_trash',['categories'=>$categories, 'search'=>$search]);
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        if(!is_null($category)){
            $category->restore();
            session()->flash('success_message','Category Restored..');
        }
        return redirect('/category_trash');    
    }

    public function forchDelete($id)
    {
        $category = Category::withTrashed()->find($id);
        if(!is_null($category)){
            $category->forceDelete();
            session()->flash('success_message','Category Removed Perminant..');
        }
        return redirect('/category_trash');    
    }

}
