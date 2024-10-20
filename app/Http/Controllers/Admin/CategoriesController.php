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
        foreach ($category->posts as $post) {
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
        return redirect()->back()->with('msg', 'Category Deleted Successfully');
    }

    public function create()
    {
        $pages = [[
            "title" => "BASIC DETAILS",
            "divs" => [
                [
                    "title" => "Basic Details",
                    "fields" => [
                        [
                            "placeholder" => "name",
                            'name' => "name",
                            "type" => "text"
                        ], [
                            "placeholder" => "Please Make Sure Your Answer Is At Least 250 Characters Long. (Success And Obstacles) ",
                            'name' => "description",
                            "type" => "textarea"
                        ], 
                        // [
                        //     "placeholder" => "Please make sure your answer is no longer than 150 characters",
                        //     'name' => "summary",
                        //     "type" => "textarea"
                        // ], 
                        [
                            "placeholder" => "Price",
                            'name' => "price",
                            "type" => "number"
                        ], [
                            'placeholder' => "Image",
                            'name' => "img",
                            "type" => "file"
                        ],

                        [
                            "placeholder" => "Select Business Model",
                            "type" => "subcategory",
                            'name' => 'subcategory'
                        ], 
                        [
                            "placeholder" => "Business Assets Included",
                            'name' => "links",
                            "type" => "links"
                        ], 
                        [
                            'placeholder' => "Add Photos And Media",
                            'name' => "assets",
                            "type" => "assets"
                        ]
                    ]
                ]
            ]
        ]];
        return response()->view('admin.category.create', ['pages' => $pages]);
    }

    public function edit($id) 
    {
        $category = Category::find($id);
        return response()->view('admin.category.edit', ['pages' => $category]);
    }

    public function update(Request $request, $category)
    {
        // Retrieve the category by its ID
        $category = Category::find($category);
        // dd($request->all());

        // Update the category data based on the form input
        $category->name_en = $request->input('name_en');
        $category->data = collect($request->input('data'))->map(function ($el) {
            $el['divs'] = collect($el['divs'])->map(function ($div) {
                $div['fields'] = collect($div['fields'])->map(function ($field) {
                    $field['data'] = json_decode($field['data'], true);
                    return $field;
                })->toArray();
                return $div;
            })->toArray();
            return $el;
        });

        // Save the updated category to the database
        $category->save();

        return redirect()->route('admin.category.index')->with('msg', "Category Updated Successfully");
    }

    

    public function store(Request $request)
    {
        Category::create([
            'name_en' => $request->input('name_en'),
            'data' => collect($request->input('data'))->map(function ($el) {
                $el['divs'] = collect($el['divs'])->map(function ($div) {
                    $div['fields'] = collect($div['fields'])->map(function ($field) {
                        $field['data'] = json_decode($field['data'], true);
                        return $field;
                    })->toArray();
                    return $div;
                })->toArray();
                return $el;
            })
        ]);
        return redirect()->route('admin.category.index')->with('msg', "Category Created Successfully");
    }
}
