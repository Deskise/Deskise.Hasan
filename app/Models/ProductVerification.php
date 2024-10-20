<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'data'
    ];

    protected $casts = [
        'data'  =>  'array'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
