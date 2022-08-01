<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'from',
        'status',
        'read',
        'updated_at'
    ];
    protected $casts = [
        'read'  =>  'boolean'
    ];
    protected $hidden = [
//        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class ,'userId','from');
    }
}
