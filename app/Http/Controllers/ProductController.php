<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != ""){
            $products = Product::where('name', 'LIKE', "%$search%")->orWhere('status', 'LIKE', "%$search%")->orWhere('user_id', 'LIKE', "%$search%")->paginate();
        }
        else{
            $products = Product::paginate(10);
        }
        
        return view('product', compact('products','search'));

    }

    public function insert(Request $request)
    {

        $validator =  $request->validate([
            'Product_name' => 'required|unique:categories',
            'status' => 'required',
            'user_id' => 'required',
        ]);

        $product = new Product;
        $product->category_name = $request->category_name;
        $product->status = $request->status;
        $product->user_id = $request->user_id;
        $product->save();

        session()->flash('success_message','Product Added..');
        return redirect('/category');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return view('Product');
        }
        else{

            $product = compact('Product');
            return view('edit_category')->with($product);
        }
        // return view('Product.edit', compact('categories'));
    }

    public function update(Request $request)
    {
        $validator =  $request->validate([
            'Product_name' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'id' => 'required',
        ]);
        $id = $request['id'];
        $product = Product::find($id);
        $product->category_name = $request->category_name;
        $product->status = $request->status;
        $product->user_id = $request->user_id;
        $product->save();

        session()->flash('success_message','Product Updated..');
        return redirect('/category');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if(!is_null($product)){
            $product->delete();
            session()->flash('success_message','Product Moved to Trash..');
        }
        return redirect('/category');    
    }

    public function trash(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != ""){
            $products = Product::where(function ($query) use($search) {
                $query->where('name', 'LIKE', "%$search%")->orWhere('status', 'LIKE', "%$search%")->orWhere('user_id', 'LIKE', "%$search%");
            })->onlyTrashed()->paginate();

        }
        else{
            $products = Product::onlyTrashed()->paginate(5);
        }
        return view('Product_trash',['products'=>$products, 'search'=>$search]);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        if(!is_null($product)){
            $product->restore();
            session()->flash('success_message','Product Restored..');
        }
        return redirect('/category_trash');    
    }

    public function forchDelete($id)
    {
        $product = Product::withTrashed()->find($id);
        if(!is_null($product)){
            $product->forceDelete();
            session()->flash('success_message','Product Removed Perminant..');
        }
        return redirect('/category_trash');    
    }
}
