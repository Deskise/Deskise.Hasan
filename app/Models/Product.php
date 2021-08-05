<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function categoory()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategoory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
