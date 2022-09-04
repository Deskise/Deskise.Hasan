<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(LoginRequest $request)
    {
        $user = Admin::where('email',$request->input('email'))->first();
        if ($user)
        {
            if (!\Hash::check($request->input('password'),$user->password)) return redirect()->back()->withErrors(['email'=>'These credentials do not match our records.']);
            \Auth::login($user);
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->withErrors(['email'=>'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin');
    }
}
