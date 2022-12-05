<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRequest;
use App\Models\SocialMediaAccount;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    //

    public function index(){
        return response()->view('admin.products.index',[
            'products'  =>  Product::paginate(20),
            'categories'=>  Category::select('id','name_en')->get()
        ]);

    }


    public function create(Category $category){
        return response()->view('admin.products.create',['categories'=>Category::select('id','name_en')->get(), 'cat'=>$category, 'links'=>SocialMediaAccount::all()]);
    }

    public function store(Request $request,Category $category){
        $request->validate([
            'is_lifetime'   =>  'accepted',
            'until' => 'date|nullable|required_without:is_lifetime',

            'name'=> 'required|string',
            'summary'=> 'required|string',
            'description'=> 'required|string',

            'price' => 'required|numeric',
            'img'=>'required|file|mimes:jpg,jpeg,png,webp',

            'subcategory' => 'required|exists:subcategories,id',
            'assets' => 'required|array',
            'assets.*'=> 'file|mimes:jpg,jpeg,png,webp|nullable',

            'links' => 'required|array',
            'links.*'   =>  'url|nullable'
        ]);

        $product = new Product([
            ...$request->all('name','summary','description','price'),
            'user_id' => 0,
            'category_id' => $category->id,
            'img' => \Storage::disk('products')->put('',$request->file('img')),
            'old_price' => $request->input('price')
        ]);
        $product->save();

        $product->data()->create([
            'subcategory_id'=> $request->input('subcategory'),
            'data'=> $request->except('is_lifetime','until','name','summary','description','price','img','subcategory','assets','links')
        ]);

        $assets = [];
        foreach ($request->file('assets') as $file)
            $assets[] = \Storage::disk('products')->put('',$file);

        $product->assets()->create([
            'assets' => $assets,
        ]);

        return redirect()->route('admin.products.index')->with('msg', 'New Product added successfully');
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
