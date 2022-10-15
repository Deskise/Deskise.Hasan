<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatControl extends Model
{
    use HasFactory;

    protected $table = 'Chat_Controls';
    public $timestamps = false;
    protected $casts =  ["blocked_keywords" => "array"];

    protected $fillable = [
        'id',
        'block_email' ,
        'block_phones',
        'blocked_keywords',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


}
