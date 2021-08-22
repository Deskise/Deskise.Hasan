<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDraft extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'is_lifetime'=>  'boolean',
        'assets'  =>  'array',
        'packages'  =>  'array',
        'data'      =>  'array',
        'socialLinks'  =>  'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
