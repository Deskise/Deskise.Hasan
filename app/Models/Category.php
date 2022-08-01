<?php

namespace App\Models;

use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public function __construct(array $attributes = [])
    {
        $this->makeHidden(APIHelper::getLangFrom('name'));
        parent::__construct($attributes);
    }

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'data'  =>  'array'
    ];

    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productRequests()
    {
        return $this->hasMany(ProductRequest::class);
    }
}
