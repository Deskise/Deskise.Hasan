<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    //

    public function index(){
        $products = Product::paginate(20);
        return response()->view('admin.products.index',compact('products'));

    }


    public function create(){
        $categories = Category::select('id','name_en')->get();
        return response()->view('admin.products.create',['categories'=>$categories]);
    }

    public function store(Request $request){
        $request->validate([
            'name_en'=> 'required|string',
            'summary_en'=> 'required|string',
            'category_id'  =>  'required|exists:categories,id',
            'description_en'=> 'required|string',
            'price' => 'required|numeric',
            'img'=>'required|file|mimes:jpg,jpeg,png,webp',
            'status'=> 'nullable|in:'.implode(',',['sold','available','canceled', 'expired']),
        ]);

        $product = new Product([
            ...$request->all(),
            'name_ar'=> '',
            'description_ar' => '',
            'summary_ar' => '',
            'old_price' => '',
            'user_id' => $request->user()->id,
        ]);
        $product->img = \Storage::disk('products')->put('',$request->file('img'));
        $product->save();


//        dd($request->all());
        dd($product);

//        if (Product::create($request->all())){
//            \Session::flash("msg", "New Product added successfully");
//            return redirect()->route('admin.products.index');
//        }
//
//        return redirect()->back();
    }

    public function edit(Product $product){

    }

    public function update(Request $request,Product $product){

    }

    public function destroy(Product $product){
        $product->delete();
        \Session::flash('msg','Product Deleted Successfully!');
        return redirect()->route('admin.products.index');
    }


}
