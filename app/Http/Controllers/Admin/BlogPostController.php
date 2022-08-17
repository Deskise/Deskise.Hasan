<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    public function index()
    {
        //
        $blogs = BlogPost::paginate(10);
        return response()->view('admin.blogs.index',compact('blogs'));
    }


    public function create()
    {
        //
        $categories = Category::select('id','name_en')->get();
        return response()->view("admin.blogs.create",compact('categories'));
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'title_en'=>'required',
            'img'=>'required|file|mimes:jpg,jpeg,png' ,
            'details_en'=> 'required',
            'tags'  =>  'required|string',
            'category_id'  =>  'required|exists:categories,id'
        ]);

        $blog = new BlogPost([
            ...$request->all(),
            'title_ar'  =>  '',
            'details_ar'  =>  '',
        ]);
        $blog->img = \Storage::disk('blog_post')->put('',$request->file('img'));
        $blog->save();


        $requestData = $request->all();

        $tags = explode(',' ,$requestData['tags']);
        $arr_ids = [] ;
        foreach ($tags as $tag) {
            if ($tag !== '') {
                if (!$t = Tag::where('tag', $tag)->first()) {
                    $t = Tag::create([
                        'tag'   =>  $tag
                    ]);
                }
                $arr_ids[] = $t->id;
            }
        }

        if(count( $arr_ids) > 0 )
            $blog->tag()->sync($arr_ids);

        if(BlogPost::create($requestData)){
            \Session::flash("msg", "added successfully");
            return redirect()->route("admin.blogs.index");
        }
        return redirect()->back();
    }



    public function edit(BlogPost $blog)
    {
        //
        $categories = Category::select('id','name_en')->get();
        $tags = $blog->blogPostTags;
        $arr_tags= [];
        foreach ($tags as $tag){
            $arr_tags[]= $tag->tag->tag;
        }
        return response()->view('admin.blogs.edit',compact('blog','categories','arr_tags'));
    }


    public function update(Request $request, BlogPost $blog)
    {
        $requestData = $request->all();
        if ($request->file('img')){
            if (!str_contains($blog->img,'default')) \Storage::disk('blog_post')->delete($blog->img);
            $blog->img = \Storage::disk('blog_post')->put('',$request->file('img'));
        }

        $tags = explode(',' ,$requestData['tags']);
        $arr_ids = [];
        foreach ($tags as $tag) {
            if ($tag !== '') {
                if (!$t = Tag::where('tag', $tag)->first()) {
                    $t = Tag::create([
                        'tag'   =>  $tag
                    ]);
                }
                $arr_ids[] = $t->id;
            }
        }

        if(count( $arr_ids) > 0 ){
            $blog->tag()->sync($arr_ids);
        }

        if ($blog->update($requestData)){
            \Session::flash("msg","The Post Was Updated successfully");
            return redirect()->route("admin.blogs.index");

        }
        return redirect()->back();
    }


    public function destroy(BlogPost $blog)
    {
        //
        $blog->delete();
        \Session::flash("msg","Blog Post Deleted successfully");
        return redirect()->route('admin.blogs.index');
    }
}


