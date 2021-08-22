<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $casts = [
        'blocked'   =>  'boolean'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function member1()
    {
        return $this->belongsTo(User::class)->find($this->member2);
    }
    public function member2()
    {
        return $this->belongsTo(User::class)->find($this->member2);
    }
    public function blocker()
    {
        return $this->belongsTo(User::class)->find($this->blocker_id);
    }

    public function users()
    {
        return [$this->member1(),$this->member2()];
    }
    public function isBlocked()
    {
        $return = new \stdClass();
        $return->isBlocked = $this->blocked;
        $return->bloker = $this->blocker();
        return $return;
    }
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
    public function agreements()
    {
        return $this->hasMany(ChatAgreement::class);
    }
    public function calls()
    {
        return $this->hasMany(ChatCall::class);
    }
    public function reports()
    {
        return $this->hasMany(ChatReport::class);
    }
    public function logs()
    {
        return $this->hasMany(ChatLog::class);
    }
}
