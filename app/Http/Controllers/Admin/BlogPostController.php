<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogPostTags;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;

class BlogPostController extends Controller
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



        $validated = $request->validate([
            'title_en'=>'required',
            'img'=>'required' ,
            'details_en'=> 'required' ,
        ]);

        $requestData = $request->all();
        if($request->img){
            $fileName = $request->img->store("public/blog_post");
            $imageName = $request->img->hashName();
            $requestData['img'] = $imageName;
        }
        // dd(    $requestData);

        $tags = explode(',' ,$requestData['tags']);

        $arr_ids = [] ;
        foreach ($tags as $tag){
            if($tag != ''){
                $is_exist_tag = Tag::where('tag' ,$tag)->first();
                if(!$is_exist_tag){
                    $t = new Tag() ;
                    $t->tag = $tag ;
                    $t->save();
                    $arr_ids[] = $t->id ;
                }else{
                    $arr_ids[] = $is_exist_tag->id ;
                }
            }

        }

        $itemDB =  BlogPost::create($requestData);;

        $itemDB =  $itemDB->fresh();
        if(count( $arr_ids) > 0 )
          $itemDB->tag()->sync(  $arr_ids);


        \Session::flash("msg","added successfully");
        return redirect(route("blog_posts.index"));
    }

    public function show(Request $request)
    {

    }
    public function edit(BlogPost $blogPost)
    {
        $categories = Category::query()->select('id','name_en')->get();
        $tags =  $blogPost->blogPostTags;
        $arr_tags= [] ;
        foreach ($tags as $tag){
            $arr_tags[]= $tag->tag->tag;
        }
        return view("admin.blogPost.edit",compact('blogPost','categories' , 'arr_tags'));
    }

    public function update(Request $request, $id)
    {
        $itemDB = BlogPost::find($id);
        $requestData = $request->all();
        if($request->img){
            $fileName = $request->img->store("public/blog_post");
            $imageName = $request->img->hashName();
            $requestData['img'] = $imageName;
        }
       // dd(    $requestData);

        $tags = explode(',' ,$requestData['tags']);

        $arr_ids = [] ;
        foreach ($tags as $tag){
            if($tag != ''){
                $is_exist_tag = Tag::where('tag' ,$tag)->first();
                if(!$is_exist_tag){
                    $t = new Tag() ;
                    $t->tag = $tag ;
                    $t->save();
                    $arr_ids[] = $t->id ;
                }else{
                    $arr_ids[] = $is_exist_tag->id ;
                }
            }

        }
        //dd($arr_ids);
        $itemDB->update($requestData);
       // dd($arr_ids);
        if(count( $arr_ids) > 0 )
            $itemDB->tag()->sync(  $arr_ids);

        session()->flash("msg","Post Was Updated successfully");
        return redirect(route("blog_posts.index"));

    }

    public function destroy($id)
    {
       BlogPost::where('id',$id)->delete();
        \Session::flash("msg","Post Deleted successfully");
        return redirect()->route('blog_posts.index');
    }
}
