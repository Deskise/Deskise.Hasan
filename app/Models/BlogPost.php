<?php

namespace App\Models;

use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    public function __construct(array $attributes = [])
    {
        $this->makeHidden(...APIHelper::getLangFrom('title,details'));
        parent::__construct($attributes);
    }

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'category_id',
    ];

    public function getImgAttribute($value)
    {
        return APIHelper::getImageUrl('blog_post',$value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(BlogPostLike::class);
    }

    public function blogPostTags()
    {
        return $this->hasMany(BlogPostTags::class);
    }
}
