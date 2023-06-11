<?php

namespace App\Http\Controllers\Api\V1_0_0;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChatController extends Controller
{
    public function getRules()
    {
        return 'rules';
    }

    public function getChats()
    {
        return APIHelper::jsonRender('', \request()?->user('api')->chats()
            ->where('blocked', false)
            ->paginate(20)
            ->map(function ($chat) {
                $chat->user = $chat->user()->select('id','firstname','lastname','img')->first();
                return $chat->lastMsg();
            })
            ->sortByDesc(fn ($c) => Carbon::make($c->lastMsg?->created_at))
            ->values()
        );
    }

    public function getBlockedChats()
    {
        return APIHelper::jsonRender('', request()?->user('api')->chats()
            ->where('blocked', true) // Filter only blocked chats
            ->paginate(20)
            ->map(function ($chat) {
                $chat->user = $chat->user()->select('id', 'firstname', 'lastname', 'img')->first();
                return $chat->lastMsg();
            })
            ->sortByDesc(fn ($c) => Carbon::make($c->lastMsg?->created_at))
            ->values()
        );
    }

    // public function getChats()
    // {
    //     $chats = \request()->user('api')->chats()
    //         ->paginate(20)
    //         ->map(function ($chat) {
    //             $chat->user = $chat->user()->select('id','firstname','lastname','img')->first();
    //             return $chat->lastMsg();
    //         })
    //         ->sortByDesc(fn ($c) => Carbon::make($c->lastMsg?->created_at))
    //         ->values();

    //     if ($chats->isEmpty()) {
    //         return APIHelper::jsonRender('', 'There is no data');
    //     }

    //     return APIHelper::jsonRender('', $chats);
    // }

    public function getMessages(Chat $chat)
    {
        $messages = $chat->messages()->select('*',\DB::raw('"message" as type'))->orderBy('created_at','desc')->paginate(25);
        if (!$messages->last()) return APIHelper::jsonRender('',$messages);
        $calls = $chat->calls()->select('*',\DB::raw('"call" as type'))->orderBy('created_at','desc')->where('created_at','>=',$messages->last()->created_at)->get();
        $agreements = $chat->agreements()->select('*',\DB::raw('"agreement" as type'))->orderBy('created_at','desc')->where('created_at','>=',$messages->last()->created_at)->get();

        $data = $messages->merge($agreements)->merge($calls)->sortByDesc('created_at')->values()
            ->each(function ($e) use ($chat) {
                $e->update(['read' => true]);
//              broadcast(new ReadEvent($chat->id, $e))->toOthers();
            });
        return APIHelper::jsonRender('',['items'=>$data,'last_page'=>$messages->lastPage(),'total'=>$messages->total()]);
    }

    public function getFiles(Chat $chat)
    {
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

    public function message(Request $request, Chat $chat, $type) {
        // dd($type);
        // if (($validator=\Validator::make($request->all(), [
        //     'message'       =>  ['string',Rule::requiredIf($type==='message')],
        //     'message'       =>  ['string',Rule::requiredIf($type==='textphoto')],

        //     'attachments'   =>  ['array','json',Rule::requiredIf($type==='attachment')],
        //     'attachments.*' =>  ['string',Rule::requiredIf($type==='attachment')],
        //     'attachments'   =>  ['array','json',Rule::requiredIf($type==='textphoto')],
        //     'attachments.*' =>  ['string',Rule::requiredIf($type==='textphoto')],

        //     'price'         =>  ['numeric',Rule::requiredIf($type==='agreement')],
        //     'notes'         =>  ['string',Rule::requiredIf($type==='agreement')],
        //     'details'       =>  ['string',Rule::requiredIf($type==='agreement')],
        //     'file_types'    =>  ['array','json',Rule::requiredIf($type==='agreement')]

        // ]))->fails()) return APIHelper::jsonRender('There Was An Error Validating Your Request', $validator->errors(), 400);
        // dd($request);
        $message = $chat->messages()->create([
            'type'  => $type,
            'from'  =>  $request->user('api')->id,
            ...match ($type) {
                'message' => [
                    'message' => $request->input('message'),
                ],
                'attachment'  => [
                    'attachments'=> $request->input('attachments')
                ],
                'textphoto' => [
                    'message' => $request->input('message'),
                    'attachments'=> $request->input('attachments')
                ],
                'agreement' => [
                    'agreement_price'       =>  $request->input('price'),
                    'agreement_notes'       =>  $request->input('notes'),
                    'agreement_details'     =>  $request->input('details'),
                    'agreement_file_types'  =>  $request->input('file_types'),
                    'status'                =>  $this->getStatus($request->input('status'))
                    // 'status'                =>  $request->input('status')
                ],
                'call'  => [
                    'status'                =>  'call_running'
                ]
            }

            
            
        ]);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName(); 
                $path = 'public/chats/'. $fileName;
                \Storage::disk('local')->put($path, file_get_contents($file));
            }
        }

        
        return APIHelper::jsonRender('success',$message);
    }

    function getStatus($inputStatus) {
        switch ($inputStatus) {
            case 'waiting':
                return 'agreement_waiting';
            case 'Accepted':
                return 'agreement_accepted';
            case 'Declined':
                return 'agreement_canceled';
            default:
                return null;
        }
    }
    
    public function report(Request $request, Chat $chat)
    {
        $request->validate([
            'notes' =>  'string|required'
        ]);
        $chat->reports()->create([
            'message'   => $request->input('notes'),
            'from'      => auth('api')->id()
        ]);
        return APIHelper::jsonRender('success',[]);
    }

    public function block(Request $request, Chat $chat)
    {
        $chat->update([
            'blocked'       =>  true,
            'blocker_id'    =>  auth('api')->id()
        ]);
        return APIHelper::jsonRender('success',$chat->refresh()->isBlocked());
    }
    public function unblock(Request $request, Chat $chat)
    {
        $chat->update([
            'blocked'       =>  false,
            'blocker_id'    =>  null
        ]);
        return APIHelper::jsonRender('success',$chat->refresh()->isBlocked());
    }
}
