<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaAccount extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function userLinks()
    {
        return $this->hasMany(SocialMediaLink::class);
    }
    public function productLinks()
    {
        return $this->hasMany(SocialMediaProductLink::class);
    }
}
