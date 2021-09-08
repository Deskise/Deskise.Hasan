<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'backup_email',
        'phone',
        'backup_phone',
        'password',
        'img',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'         => 'datetime',
        'backup_email_verified_at'  => 'datetime',
        'phone_verified_at'         => 'datetime',
        'backup_phone_verified_at'  => 'datetime',
        'id_verified_at'            => 'datetime',
        'is_closed'                 => 'boolean',
        'is_hidden'                 => 'boolean',
    ];

    public function links()
    {
        return $this->hasMany(SocialMediaLink::class);
    }

    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }

    public function productsBought()
    {
        return $this->hasMany(ProductBuy::class);
    }
    public function views()
    {
        return $this->hasMany(ProductView::class);
    }
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
    public function settings()
    {
        return $this->hasOne(UserSettings::class);
    }
    public function transitions()
    {
        return $this->hasMany(Transition::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class,['member1','member2']);
    }
    public function blocks()
    {
        return $this->hasMany(Chat::class,'blocker_id');
    }
    public function verifyAssets()
    {
        return $this->hasOne(UserVerificationAssets::class);
    }
    public function ProductLikes()
    {
        return $this->belongsTo(ProductLikes::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}