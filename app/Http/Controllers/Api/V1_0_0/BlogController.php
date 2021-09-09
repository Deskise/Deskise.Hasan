<?php

namespace App\Http\Controllers\Api\V1_0_0;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogPostLike;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function posts()
    {
        $data = BlogPost::select('id','title_'.self::$language.' as title','details_'.self::$language.' as details','img','category_id','updated_at as date')
            ->with('category:id,name_'.self::$language.' as name')
            ->paginate(12);

        return APIHelper::jsonRender('', $data);
    }

    public function post(BlogPost $post, Request $request)
    {
        if (!$request->has('uuid'))
        {///TODO: Do The Translation Shit;
            return APIHelper::jsonRender('you must provide device\'s (uuid) with the request', [],403);
        }

        $post->title = $post->{'title_'.self::$language};
        $post->details = $post->{'details_'.self::$language};
        $post->category = $post->category()->select(['id','name_'.self::$language.' as name'])->get()->first();
        $post->img = APIHelper::getImageUrl($post->img);
        $post->likes = $post->likes()->get()->count();
        $post->liked = $post->likes()->where('uuid','=',$request->input('uuid'))->get()->count()>0;
        $post->date = $post->updated_at;
        $post->makeHidden([...APIHelper::getLangFrom('title,details'),'category_id']);

        $post->similar = APIHelper::getSimilar(BlogPost::class,['id','title_'.self::$language.' as name','details_'.self::$language.' as details','img','updated_at as date']);

        return APIHelper::jsonRender('', $post);
    }

    public function category(Category $category)
    {
        $data = $category->posts()->select('id','title_'.self::$language.' as title','details_'.self::$language.' as details','img','category_id','updated_at as date')
            ->paginate(12);
        return APIHelper::jsonRender('', $data);
    }

    public function like(Request $request,BlogPost $post)
    {
        ///TODO: Do The Translation Shit;
        if (!$request->has('uuid'))
        {
            return APIHelper::jsonRender('you must provide device\'s (uuid) with the request', [],403);
        }
        if (!$post->exists)
        {
            return APIHelper::jsonRender('The required post do not exist', [],403);
        }

        $like = BlogPostLike::where('uuid','=',$request->input('uuid'))->get()->first();
        if ($like===null)
        {
            $like = $post->likes()->create(['uuid'  =>  $request->input('uuid')]);
            return APIHelper::jsonRender('article liked successfully', []);
        }

        $like->delete();
        return APIHelper::jsonRender('article disliked successfully', []);
    }

    public function search(Request $request)
    {
        $q = explode('-',Str::slug(urldecode($request->input('q'))));
        $data = BlogPost::select(['id','title_'.self::$language.' as name','details_'.self::$language.' as details','img','updated_at as date']);

        foreach ($q as $item)
        {
            $data->orWhere('title_'.self::$language,'LIKE',"%$item %");
            $data->orWhere('details_'.self::$language,'LIKE',"%$item %");
        }
        $data = $data->paginate(12);

        return APIHelper::jsonRender('', $data);
    }
}
