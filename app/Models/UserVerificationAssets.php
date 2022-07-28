<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerificationAssets extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'assets', 'rejectMassage'];

    protected $casts = [
        'assets'    =>  'array'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
