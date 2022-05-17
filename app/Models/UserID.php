<?php

namespace App\Models;

use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserID extends Model
{
    use HasFactory;

    protected $table ='user_ids';
    protected $fillable = [
        'identity',
        'user_id',
        'status',
        'notes'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
