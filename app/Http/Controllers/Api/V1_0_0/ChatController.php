<?php

namespace App\Http\Controllers\Api\V1_0_0;

use App\Events\ReadEvent;
use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatAgreement;
use App\Models\ChatCall;
use App\Models\ChatMessage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getRules()
    {
        return 'rules';
    }

    public function getChats()
    {
        return APIHelper::jsonRender('', \request()?->user('api')->chats()
            ->paginate(20)
            ->map(function ($chat) {
                $chat->user = $chat->user()->select('id','firstname','lastname','img')->first();
                return $chat->lastMsg();
            })
            ->sortByDesc(fn ($c) => Carbon::make($c->lastMsg->created_at))
            ->values());
    }

    public function getMessages(Chat $chat)
    {
        $messages = $chat->messages()->select('*',\DB::raw('"message" as type'))->orderBy('created_at','desc')->paginate(25);
        if (!$messages->last()) return APIHelper::jsonRender('',$messages);
        $calls = $chat->calls()->select('*',\DB::raw('"call" as type'))->orderBy('created_at','desc')->where('created_at','>=',$messages->last()->created_at)->get();
        $agreements = $chat->agreements()->select('*',\DB::raw('"agreement" as type'))->orderBy('created_at','desc')->where('created_at','>=',$messages->last()->created_at)->get();

        $data = $messages->merge($agreements)->merge($calls)->sortByDesc('created_at')->values()->each(function ($e) use ($chat) {
            $e->update(['read' => true]);
            broadcast(new ReadEvent($chat->id, $e))->toOthers();
        });
        return APIHelper::jsonRender('',['items'=>$data,'last_page'=>$messages->lastPage(),'total'=>$messages->total()]);
    }

    public function getFiles(Chat $chat)
    {
        $attachments = [];
        $chat->files()->paginate(30)->each(function($e) use (&$attachments, $chat){
            foreach ($e->attachments as $attachment) {
                $attachments[] = (object)['image' => route('images', ['for' => 'chats.'.$chat->id,'image'=>$attachment]),'created_at' => $e->created_at];
            }
        });
        return APIHelper::jsonRender('',$attachments);
    }

    public function getAgreements(Chat $chat)
    {
        return APIHelper::jsonRender('',$chat->agreements()->orderBy('created_at','desc')->paginate(20)->items());
    }

    public function sendMessage(Request $request, Chat $chat) {
        $request->validate([
            'message'   =>  'nullable|required_unless:attachments,not null',
            'attachments'=> 'array|nullable',
            'attachments.*' =>  'string|nullable'
        ]);
        $chat->messages()->create([
            'from'  =>  $request->user('api')->id,
            'message' => $request->input('message'),
            'attachments'=>$request->input('attachments')
        ]);

        return APIHelper::jsonRender('success',[]);
    }
}
