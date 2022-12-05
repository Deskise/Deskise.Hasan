<?php

namespace App\Models;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'backup_email',
        'phone',
        'backup_phone',
        'password',
        'img',
        'banner',
        'banned',
        'location',
        'facebook_id',
        'google_id',
        'is_hidden',
        'is_closed',
        'id_verified_at'
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

    protected static function boot()
    {
        static::created(function ($user){
            $user->settings()->create([
                'allowed_alarms'    =>  [
                    'email' =>  true,
                    'admin' =>  true,
                    'message' =>  true,
                    'call' =>  true,
                ],
                'affiliate_links'   =>  true
            ]);
        });
        parent::boot();
    }

    public function getImgAttribute($value)
    {
        return APIHelper::getImageUrl('users', $value);
    }

    public function getBannerAttribute($value)
    {
        return APIHelper::getImageUrl('users', $value);
    }

    public function links()
    {
        return $this->hasMany(SocialMediaLink::class)->with('account:id,icon');
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
        return $this->hasMany(UserPackage::class);
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
        return Chat::where('member1',$this->id)
            ->orWhere('member2', $this->id)
            ->with('product:id,name_'.Controller::$language.' as name,summary_'.Controller::$language.' as description,old_price,price');
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

    public function assets()
    {
        return $this->hasOne(UserVerificationAssets::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
