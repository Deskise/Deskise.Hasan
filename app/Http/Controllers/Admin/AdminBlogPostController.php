<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogPostTags;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminBlogPostController extends Controller
{

    public function index()
    {
        $blogs = BlogPost::query()->paginate(10);
        return view("admin.blogPost.index",compact('blogs'));
    }

    public function create()
    {
        $categories = Category::query()->select('id','name_en')->get();
        return view("admin.blogPost.create",compact('categories'));
    }

    public function store(Request $request)
    {
        $requestData = $request->only('title_en','details_en','title_ar','details_ar','img','category_id');
        $bog = BlogPost::create($requestData);
        
        \Session::flash("msg","added successfully");
        return redirect(route("blog_posts.index"));
    }


    public function edit(BlogPost $blogPost)
    {
        $categories = Category::query()->select('id','name_en')->get();
        return view("admin.blogPost.edit",compact('blogPost','categories'));
    }

    public function update(Request $request, $id)
    {
        $itemDB = BlogPost::find($id);
        $requestData = $request->all();
        if($request->img){
            $fileName = $request->img->store("public/images");
            $imageName = $request->img->hashName();
            $requestData['img'] = $imageName;
        }
        $itemDB->update($requestData);

        session()->flash("msg","s:تم التحديث بنجاح ");
        return redirect(route("blog_posts.index"));

    }

    public function destroy($id)
    {
       BlogPost::where('id',$id)->delete();
        \Session::flash("msg","Post Deleted successfully");
        return redirect()->route('blog_posts.index');
    }
}
