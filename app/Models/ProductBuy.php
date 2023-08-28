<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBuy extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'price',
        'website_share',
        'transaction_id',
        'affiliate_code',
        'affiliate_share'
    ];

    protected $hidden = [
        // 'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
