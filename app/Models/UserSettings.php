<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;

    protected $fillable = ['allowed_alarms','affiliate_links'];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'allowed_alarms'    =>  'json',
        'affiliate_links'   =>  'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
