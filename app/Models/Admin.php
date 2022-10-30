<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens ;

    protected $table = 'admins' ;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'img',
        'role',
        'bio'
    ];

    public function hasRole($role) {
        return in_array($this->role, $role);
    }

//    public function setPasswordAttribute($value){
//        $this->attributes['password'] = Hash::make($value);
//    }
}
