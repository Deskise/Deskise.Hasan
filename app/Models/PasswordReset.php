<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    const UPDATED_AT = null;

    protected $fillable = [
        'email',
        'token'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
    ];
}