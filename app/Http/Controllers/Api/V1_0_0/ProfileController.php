<?php

namespace App\Http\Controllers\Api\V1_0_0;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Rules\FileOrUrl;
use Illuminate\Http\Request;
use JsonException;

class ProfileController extends Controller
{
    /**
     * @throws JsonException
     */
    public function userData(Request $request)
    {
        $request->validate([
            'firstname'    =>  'required|string|min:3',
            'lastname'     =>  'required|string|min:3',
            'email'        =>  'required|email',
            'img'          =>  ['required', new FileOrUrl()],

            'phone'        =>  'string|nullable',
            'bio'          =>  'string|nullable',
            'backup_email' =>  'email|nullable',
            'backup_phone' =>  'string|nullable',
            'location'     =>  'string|nullable',
            'links'        =>  'array|nullable'
        ]);


        $user = $request->user();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->img = ($request->hasFile('img'))?
            \Storage::disk('users')->put('',$request->file('img')):
            preg_replace('/.+\/images\//','',$request->input('img'));
        if ($request->has('phone')) $user->phone = $request->input('phone');
        if ($request->has('bio')) $user->bio = $request->input('bio');
        if ($request->has('backup_email')) $user->backup_email = $request->input('backup_email');
        if ($request->has('backup_phone')) $user->backup_phone = $request->input('backup_phone');
        if ($request->has('location')) $user->location = $request->input('location');
        $user->save();

        foreach ($request->input('links') as $link)
        {
            $link = json_decode($link, false, 512, JSON_THROW_ON_ERROR);
            $user->links()->updateOrCreate([
                'id' => $link->id
            ],[
                'social_id' =>  $link->social_id,
                'link'      =>  $link->link
            ]);
        }

        return APIHelper::jsonRender('Data Updated Successfully',$user->load(['links','verifyAssets','packages']));
    }

    public function alerts(Request $request)
    {
        $request->validate([
            'email'     => 'required|boolean',
            'admin'     => 'required|boolean',
            'message'   => 'required|boolean',
            'call'      => 'required|boolean',
        ]);

        $request->user()->settings()->update([
            'allowed_alarms'    =>  $request->all()
        ]);

        return APIHelper::jsonRender('Data Updated Successfully',[]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password'      =>  'required|string',
            'new_password'      =>  'required|string|confirmed',
        ]);

        if (!\Hash::check($request->input('old_password'),$request->user()->password)) return APIHelper::error('old password is not right');

        $request->user()->update([
            'password'  =>  \Hash::make($request->input('new_password'))
        ]);

        return APIHelper::jsonRender('Data Updated Successfully', []);
    }

    public function closeAccount(Request $request)
    {
        $request->user()->update([
            'is_closed' => true
        ]);
        return APIHelper::jsonRender('Account Has Been Closed Successfully',[]);
    }
}
