<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'from',
        'details',
        'notes',
        'price',
        'file_types',
        'status',
        'read',
        'updated_at'
    ];

    protected $casts = [
        'file_types'    =>  'array',
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
