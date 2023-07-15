<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affiliate extends Model
{
    use HasFactory;
    protected $fillable = [
        'affiliator_id',
        'owner_id' ,
        'product_id' ,
        'tracking_code',
        'tracking_url',
    ];

    public function affiliator()
    {
        return $this->belongsTo(User::class, 'affiliator_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
