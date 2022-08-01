<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'from',
        'message',
        'attachments',
        'read',
        'updated_at'
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'attachments'=>'json',
        'read'  =>  'bool'
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
