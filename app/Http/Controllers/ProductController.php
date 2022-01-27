<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
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

    public function detail($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return view('product');
        }
        else{
            $products = Product::get();
            $product = compact('product');
        }
        return view('product_detail')->with($product);
    }

    public function create()
    {
        $categories = Category::all();        
        return view('product_create', compact('categories'));
    }

    public function created(Request $request)
    {

        $validator =  $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'price' => 'required',
            'user_id' => 'required',
            'category' => 'required|array|min:1',
            'category.*' => 'required|integer|exists:categories,id',
        ]);
    
        $image = $request->file('img');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->quantity = $request->quantity;
        $product->image = $imageName;
        $product->user_id = $request->user_id;
        $product->save();

        $product->categories()->attach($request->category);

        session()->flash('success_message','Product Added..');
        return redirect('product/create');
       
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

    public function edited(Request $request)
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

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);
        if(!is_null($product)){
            $product->forceDelete();
            session()->flash('success_message','Product Removed Perminant..');
        }
        return redirect('/category_trash');    
    }
}
