<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostTags extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class );
}
}