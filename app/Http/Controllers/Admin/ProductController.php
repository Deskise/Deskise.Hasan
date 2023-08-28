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

    public function show(Request $request)
    {
        $search = $request->search;
        $products = Product::where(function($query) use ($search) {
            $query->where('name', 'like',  "%$search%")
                ->orWhere('status', 'like', "%$search%")
                    ->orWhereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('firstname', 'like', "%$search%")
                        ->orWhere('lastname', 'like', "%$search%");
                })
                ->orWhere('description', 'like', "%$search%");
        })
        ->paginate(20);
        $products->appends(['search' => $search]);

        return response()->view('admin.products.index', [
            'products' => $products,
            'categories'=>  Category::select('id','name_en')->get(),
            'search' => $search

        ]);
    }



    public function create(Category $category){
        return response()->view('admin.products.create',['categories'=>Category::select('id','name_en')->get(), 'cat'=>$category, 'links'=>SocialMediaAccount::all()]);
    }

    public function store(Request $request,Category $category){
        $request->validate([
            // 'is_lifetime'   =>  'accepted',
            'until' => 'date|nullable|required_without:is_lifetime',

            'name'=> 'required|string',
            'summary'=> 'required|string',
            'description'=> 'required|string',

            'price' => 'required|numeric',
            'img'=>'required|file|mimes:jpg,jpeg,png,webp',

            'subcategory' => 'required|exists:subcategories,id',
            // 'assets' => 'required|array',
            // 'assets.*'=> 'file|mimes:jpg,jpeg,png,webp|nullable',

            'links' => 'required|array',
            'links.*'   =>  'url|nullable'
        ]);

        $isLifetime = $request->has('is_lifetime');
        if ($isLifetime === 'on') {
            $isLifetime = true;
        } else {
            $$isLifetime = false;
        }

        $file = $request->file('img');
        $fileName = time() . \Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = 'public/products/' . $fileName;
        \Storage::disk('local')->put($path, file_get_contents($file));
        $product = new Product([
            ...$request->all('name','summary','description','price'),
            // ...$request->except('is_lifetime', 'img', 'until'),
            'user_id' => 0,
            'category_id' => $category->id,
            'img' => $fileName,
            // 'img' => \Storage::disk('products')->put('',$request->file('img')),
            'old_price' => $request->input('price'),
            'until' => $request->input('until'),
            'is_lifetime' => $isLifetime,
        ]);
        $product->save();
    
        $links = $request->input('links'); 
        foreach ($links as $key => $link) {
            if ($link !== null) {
                $product->social()->create([
                    'social_id' => $key,
                    'link' => $link,
                ]);
            }
        }

        $product->data()->create([
            'subcategory_id'=> $request->input('subcategory'),
            'data'=> $request->except('is_lifetime','until','name','summary','description','price','img','subcategory','assets','links')
        ]);

        // $assets = [];
        // foreach ($request->file('assets') as $file)
        //     $assets[] = \Storage::disk('products')->put('',$file);

        // $product->assets()->create([
        //     'assets' => $assets,
        // ]);

        return redirect()->route('admin.products.index')->with('msg', 'New Product added successfully');
    }

    public function edit(Product $product){
        // dd($product);
        $social = $product->social()->get();
        $cat = Category::find($product->category_id);
        $subCategory = $cat->with('subcategories')->get();

        return response()->view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::select('id','name_en')->get(),
            'links' => SocialMediaAccount::all(),
            'social' => $social,
            'cat' => $cat
        ]);
    }

    public function update(Request $request,Product $product){
        // dd($request->all());

        $request->validate([
            // 'is_lifetime'   =>  'accepted',
            'until' => 'date|nullable|required_without:is_lifetime',

            'name'=> 'required|string',
            'summary'=> 'required|string',
            'description'=> 'required|string',

            'price' => 'required|numeric',
            'img'=>'required|file|mimes:jpg,jpeg,png,webp',

            'subcategory' => 'required|exists:subcategories,id',
            // 'assets' => 'required|array',
            // 'assets.*'=> 'file|mimes:jpg,jpeg,png,webp|nullable',

            'links' => 'required|array',
            'links.*'   =>  'url|nullable'
        ]);
         $isLifetime = $request->input('is_lifetime');
            if ($isLifetime === 'on') {
                $isLifetime = 1;
            } else {
                $isLifetime = 0;
            }

    $product->update([
        'name' => $request->input('name'),
        'summary' => $request->input('summary'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        // 'subcategory_id' => $request->input('subcategory'),
        'until' => $request->input('until'),
        'is_lifetime' => $isLifetime,
        'verified' => 1
    ]);

    if ($request->hasFile('img')) {
        $file = $request->file('img');
        $fileName = time() . \Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = 'public/products/' . $fileName;
        \Storage::disk('local')->put($path, file_get_contents($file));
        \Storage::disk('local')->delete('public/products/' . $product->img);
        $product->update(['img' => $fileName]);
    }

    // Update links
    $links = $request->input('links'); 
    $product->social()->delete(); // Delete existing social links
    foreach ($links as $key => $link) {
        if ($link !== null) {
            $product->social()->create([
                'social_id' => $key,
                'link' => $link,
            ]);
        }
    }

    $product->data()->update([
        'subcategory_id'=> $request->input('subcategory'),
        'data'=> $request->except('is_lifetime','until','name','summary','description','price','img','subcategory','assets','links')
    ]);

    return redirect()->route('admin.products.index')->with('msg', 'Product updated successfully');

    }

    public function destroy(Product $product){
        $product->delete();
        \Session::flash('msg','Product Deleted Successfully!');
        return redirect()->route('admin.products.index');
    }


}
