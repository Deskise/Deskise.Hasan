<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens ;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'img',
        'role'
    ];

    public function hasRole(...$role) {
        return in_array($this->role, $role);
    }
}
