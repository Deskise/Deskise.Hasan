<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoriesController extends Controller
{
    //

    public function index()
  {
    $categories = Category::with('subcategories')->get();

    return response()->view('admin.subcategories.index', [
        'categories' => $categories,
    ]);
  }
    public function destroy(Subcategory $subcategory)
    {
        foreach ($subcategory->productRequests as $productRequest) $productRequest->delete();
        $subcategory->delete();
        
        return redirect()->back()->with('msg', 'Subcategory Deleted Successfully');
    }

    public function update(Request $request, $subcategory)
    {
        $subcategory = Subcategory::find($subcategory);
        $subcategory->name_en = $request->input('name_en');
        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('msg', "Subcategory Updated Successfully");
    }

    

    public function store(Request $request)
    {
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        $category->subcategories()->create([
            'name_en' => $request->name_en
        ]);
        return redirect()->route('admin.subcategories.index')->with('msg', "Subcategory Created Successfully");
    }
}
