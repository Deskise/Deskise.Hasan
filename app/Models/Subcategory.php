<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function data()
    {
        return $this->hasMany(ProductData::class);
    }
    public function products()
    {
        return $this->data()->product()->get();
    }

    public function productRequests()
    {
        return $this->hasMany(ProductRequest::class);
    }
}
