<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return response()->view('admin.contactUs.index',[
            'contacts'  =>  ContactMessage::with('contact')->paginate(20),
        ]);
    }

    public function destroy($id)
    {        
        $message = ContactMessage::find($id);
        $message->delete();
        \Session::flash('msg','Message Deleted Successfully!');
        return redirect()->route('admin.contact.index');
    }
}
