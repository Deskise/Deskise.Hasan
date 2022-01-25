<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $guarded = [];

    protected $casts = [
        'special'   =>  'boolean',
        'verified'   =>  'boolean',
        'is_lifetime'=>  'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function data()
    {
        return $this->hasOne(ProductData::class);
    }
    public function social()
    {
        return $this->hasMany(SocialMediaProductLink::class);
    }
    public function bought()
    {
        return $this->hasMany(ProductBuy::class);
    }
    public function packages()
    {
        return $this->hasMany(ProductPackage::class);
    }
    public function views()
    {
        return $this->hasMany(ProductView::class);
    }
    public function assets()
    {
        return $this->hasOne(ProductAssets::class);
    }
    public function verification()
    {
        return $this->hasOne(ProductVerification::class);
    }
    public function draft()
    {
        return $this->hasOne(ProductDraft::class);
    }
    public function likes()
    {
        return $this->hasMany(ProductLikes::class);
    }

    public function hasHiddenSeller()
    {
        return $this->user->ishiddem;
    }
}
