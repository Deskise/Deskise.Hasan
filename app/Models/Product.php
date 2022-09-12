<?php

namespace App\Models;

use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'special'   =>  'boolean',
        'verified'   =>  'boolean',
        'is_lifetime'=>  'boolean',
        'until'=>  'date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function getImgAttribute($value)
    {
        return APIHelper::getImageUrl('products',$value);
    }
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
    public function drafts()
    {
        return $this->hasMany(ProductDraft::class);
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
