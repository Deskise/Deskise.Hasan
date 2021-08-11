<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostLike extends Model
{
    use HasFactory;

    protected $fillable = ['blog_post_id','uuid'];

    protected $hidden = [
        'created_at'
    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
