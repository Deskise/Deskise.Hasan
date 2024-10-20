<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'member1',
        'member2',
        'blocked',
        'blocker_id',
        'product_id'
    ];

    protected $casts = [
        'blocked'   =>  'boolean'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'member1',
        'member2',
        'product_id',
        'blocked',
        'blocker_id'
    ];

    public function user()
    {
        if ($this->member1 !== auth('api')->id() || $this->member1 !== auth()->id())
            return $this->belongsTo(User::class, 'member1');
        else
            return $this->belongsTo(User::class, 'member2');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function blocker()
    {
        return $this->belongsTo(User::class, 'blocker_id');
    }

    public function isBlocked()
    {
        $this->block = (object)['isBlocked' => $this->blocked, 'canUnBlock' => $this->blocker_id === request()->user('api')?->id??''];
        return $this;
    }

    public function lastMsg()
    {
        $this->lastMsg = $this->messages()->latest()->limit(1)->first();
        return $this;
    }

    public function files()
    {
        return $this->messages()->select('id', 'chat_id', 'attachments', 'created_at')->whereNotNull('attachments')->orderBy('created_at', 'desc');
    }
    public function users()
    {
        return [$this->member1, $this->member2];
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
