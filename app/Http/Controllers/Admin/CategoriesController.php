<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //

    public function index()
    {
        return response()->view('admin.category.index', [
            'categories' => Category::paginate(25),
        ]);
    }

    public function destroy(Category $category)
    {
        foreach($category->posts as $post) {
            $post->likes()->delete();
            $post->blogPostTags()->delete();
            $post->delete();
        }
        foreach ($category->subcategories as $subcategory) {
            $subcategory->data()->delete();
            $subcategory->productRequests()->delete();
            $subcategory->delete();
        }
        foreach ($category->products as $product) {
            $product->data()->delete();
            $product->social()->delete();
            $product->bought()->delete();
            $product->packages()->delete();
            $product->views()->delete();
            $product->assets()->delete();
            $product->verification()->delete();
            $product->drafts()->delete();
            $product->likes()->delete();
        }
        foreach ($category->productRequests as $productRequest) $productRequest->delete();
        $category->delete();
        return redirect()->back()->with('msg','Category Deleted Successfully');
    }

    public function create()
    {
        $pages = [[
            "title" => "BASIC DETAILS",
            "divs" => [
                [
                    "title"=>   "Basic Details",
                    "fields"=>  [
                        [
                            "placeholder"=> "name",
                            'name'  =>  "name",
                            "type"  =>  "text"
                        ],[
                            "placeholder"=> "Please Make Sure Your Answer Is At Least 250 Characters Long. (Success And Obstacles) ",
                            'name'  =>  "description",
                            "type"  =>  "textarea"
                        ],[
                            "placeholder"=> "Please make sure your answer is no longer than 150 characters",
                            'name'  =>  "summary",
                            "type"  =>  "textarea"
                        ],[
                            "placeholder"=> "Price",
                            'name'  =>  "price",
                            "type"  =>  "number"
                        ],[
                            'placeholder' => "Image",
                            'name'  =>  "img",
                            "type"  =>  "file"
                        ],

                        [
                            "placeholder"  =>  "Select Business Model",
                            "type"  =>  "subcategory",
                            'name'  =>  'subcategory'
                        ],[
                            "placeholder" =>  "Business Assets Included",
                            'name'  =>  "links",
                            "type"  =>  "links"
                        ],[
                            'placeholder' => "Add Photos And Media",
                            'name'  =>  "assets",
                            "type"  =>  "assets"
                        ]
                    ]
                ]
            ]
        ]];
        return response()->view('admin.category.create', ['pages' => $pages]);
    }

    public function store(Request $request)
    {
        $request->validate([

        ]);
    }



}
