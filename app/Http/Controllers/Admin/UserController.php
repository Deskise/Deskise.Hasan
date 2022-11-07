<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatReport;
use App\Models\Notification;
use App\Models\Product;

class UserController extends Controller
{

    public function index()
    {
        //
        $allUsers = User::paginate(10);
        return response()->view('admin.users.index', ['allUsers' => $allUsers]);
    }


    public function show(User $user)
    {
        //
        $products = Product::where('user_id', $user->id)->paginate(5);
        return response()->view('admin.users.showUser', ['user' => $user, 'products' => $products]);
    }

    public function update(User $user)
    {
        $user->update([
            'banned' => !$user->banned
        ]);

        return redirect()->back()->with('msg', 's:Updated Successfully!');
    }

    public function userChat(Request $request, User $user, $chat=null)
    {
        $chats = Chat::where('member1', $user->id)->orWhere('member2', $user->id)->with('messages')->orderBy('created_at', 'desc')->get();
        if ($chat)
            $messages = $chats->filter(fn($e) => $e->id == $chat)->first()->messages;
        else $messages = $chats->first()->messages;

        return response()->view('admin.users.userChats', [
            'chats'   => $chats,
            'chat_id' => $chat??$messages->first()->chat_id,
            'user_id' => $user->id,
            'recMsgs' => $messages
        ]);
    }

    public function changeBlock(Request $request, User $user,Chat $chat)
    {
        $chat->update([
            'blocked' => !$chat->blocked,
            'blocker_id' => 0
        ]);
        // dd($chat);
        return redirect()->back()->with('msg', "Successfully ". ($chat->refresh()->blocked ? 'Blocked' : 'Unblocked'));
    }

    public function userReports(User $user)
    {
        // $reports = DB::table('chat_reports')->where("chat_reports.from", '=',  $user->id);
        $reports = ChatReport::where("from", '=', $user->id)->paginate(10);
        return response()->view('admin.users.userReports', compact('reports'));
    }

    public function msgPage(User $user)
    {
        return response()->view('admin.users.msgPage', compact('user'));
    }

    public function sendMsg(Request $request, User $user)
    {

        $request->validate([
            'body' => 'string|required|max:600',
            'image' => 'file|mimes:jpg,jpeg,png,webp',
            'title' => 'string|required|max:200',
            'type' => 'required|in:' . implode(',', ['admin', 'normal'])
        ]);

        $msg = new Notification([
            'user_id' => $user->id,
            ...$request->all(),
        ]);
        if ($request->file('image')) {
            $msg->image = \Storage::disk('notification')->put('', $request->file('image'));
        }
        if ($msg->save()) {
            \Session::flash("msg", "s:Message Sent successfully");
            return redirect()->route('admin.users.show', $user->id);
        }
        return redirect()->back();
    }

    function upload_file(Request $request, Chat $chat) {
        $request->validate([ 'file' => 'required|file' ]);

        \Storage::disk('chats')->put($chat->id.'/', $request->file('file'));
        return redirect()->back()->with('msg','Successfully Uploaded');
    }
}
