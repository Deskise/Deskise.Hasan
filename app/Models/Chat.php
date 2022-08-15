<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

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
        if ($this->member1 !== request()->user('api')->id)
            return $this->belongsTo(User::class,'member1');
        else
            return $this->belongsTo(User::class,'member2');
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
        $this->block = (object)['isBlocked'=>$this->blocked,'canUnBlock'=>$this->blocker_id===request()->user('api')->id];
        return $this;
    }

    public function lastMsg()
    {
        $this->lastMsg = (object)collect([
            $this->messages()
                ->select('id','from','message','attachments','created_at','read',\DB::raw("'message' as type"))
                ->orderBy('created_at','desc')->first(),
            $this->calls()
                ->select('id','from', 'status','created_at','read',\DB::raw("'call' as type"))
                ->orderBy('created_at','desc')->first(),
            $this->agreements()
                ->select('id','from','details','status','read',\DB::raw("'agreement' as type"))
                ->orderBy('created_at','desc')->first()
        ])->sortBy('created_at')->last();
        if ($this->lastMsg !== Null) $this->lastMsg = $this->lastMsg->toArray();
        return $this;
    }

    public function files()
    {
        return $this->messages()->select('id','chat_id','attachments','created_at')->whereNotNull('attachments')->orderBy('created_at','desc');
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
