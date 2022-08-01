<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductData extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'data' =>  'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
