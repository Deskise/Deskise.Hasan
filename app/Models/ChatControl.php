<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatControl extends Model
{
    use HasFactory;

    protected $table = 'Chat_Controls';

    protected $fillable = [
        'block_email' ,
        'block_phones',
        'blocked_keywords',
    ];

}
