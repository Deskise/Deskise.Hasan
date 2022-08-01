<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaProductLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_id',
        'link'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function account()
    {
        return $this->belongsTo(SocialMediaAccount::class,'social_id','id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
