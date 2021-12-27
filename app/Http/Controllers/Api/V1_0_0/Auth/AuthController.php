<?php

    /// TODO: Read This Shit And Finish It (with translation)
    namespace App\Http\Controllers\Api\V1_0_0\Auth;

    use App\Helpers\APIHelper;
    use App\Http\Requests\ForgetRequest;
    use App\Http\Requests\LoginRequest;
    use App\Http\Requests\ResetRequest;
    use App\Http\Requests\SignupByRequest;
    use App\Http\Requests\SignupRequest;
    use App\Http\Requests\VerifyRequest;
    use App\Mail\reset;
    use App\Mail\signup;
    use App\Mail\Verified;
    use App\Mail\verify;
    use App\Models\Newsletter;
    use App\Models\PasswordReset;
    use GuzzleHttp\Exception\ClientException;
    use GuzzleHttp\Exception\ConnectException;
    use Hash;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Testing\Fluent\Concerns\Has;
    use Mockery\Generator\StringManipulation\Pass\Pass;

    class AuthController extends Controller
    {
        protected $client;

        public function __construct()
        {
            $this->client = new \GuzzleHttp\Client(['verify' => false]);
        }

        private function getImageUrl()
        {
            if (\request('facebook_id'))
                return \request('image').'?height=720';
            else if (\request('google_id')) {
                $image = explode('=s', \request('image'));
                $image[1] = explode('-',$image[1]);
                $image[1][0] = 720;
                $image[1] = implode('-', $image[1]);
                return implode('=s', $image);
            }
            return \request('image');
        }

        public function signup(SignupRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            $user = User::where('email', '=', $request->input('email'))->first();
            if (is_null($user))
            {
                $user = new User([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                ]);
                if ($request->input('password'))
                {
                    $user->password = Hash::make($request->input('password'));
                }
            }

            if ($request->input('google_id')) {
                $user->google_id = $request->input('google_id');
                if ($request->input('image')) {
                    $user->img = $name = 'user_'.uniqid('',true).'_'.time().'.jpeg';
                    \Storage::disk('users')->put($name, file_get_contents($this->getImageUrl()));
                }
            }
            if ($request->input('facebook_id'))
            {
                $user->facebook_id = $request->input('facebook_id');
                if ($request->input('image')) {
                    $user->img = $name = 'user_'.uniqid('',true).'_'.time().'.jpeg';
                    \Storage::disk('users')->put($name, file_get_contents($this->getImageUrl()));
                }
            }
            if ($request->input('uuid'))
            {
                $user->uuid = $request->input('uuid');
                //TODO: DO THE UUID CHANGE SHIT
            }

            $user->save();
            \Mail::to($user)->send(new signup());

            if (!($request->input('google_id')&&$request->input('facebook_id')))
            {
                $verification = $user->verifications()->create([
                    'verifyFor' =>  'email',
                    'verifyCode'=>  \Str::random(8),
                ]);
                \Mail::to($user)->send(new verify($verification));
            }

            if ($request->input('newsletter_subscribe'))
            {
                if (Newsletter::where('email','=',$request->input('email'))->first() === null)
                {
                    $newsletter = new Newsletter([
                        'email' =>  $request->input('email'),
                    ]);
                    $newsletter->save();
                }
            }

            return APIHelper::jsonRender('Successfully created user!', $user, 201);
        }

        public function verify(VerifyRequest $request,$type)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            $user = User::where('email','=',$request->input('email'))->first();

            if ($user->{strtolower($type).'_verified_at'}===NULL)
            {
                $verification = $user->verifications()->where('verifyFor','=',strtolower($type))->first();
                if ($request->input('verify_code')===$verification->verifyCode)
                {
                    $user->{strtolower($type).'_verified_at'} = now();
                    if ($user->save())
                    {
                        \Mail::to($user)->send(new Verified());
                        $verification->delete();
                        return APIHelper::jsonRender('user Verified successfully', []);
                    }

                    return APIHelper::error('Error Saving Verification Data, Try Again Please');
                }

                return APIHelper::error('verification code Provided is wrong');
            }

            return APIHelper::error('user already verified');
        }
        public function resendVerification(Request $request, $type)
        {
            $validater = Validator::make($request->all(),[
                'email' =>  'required|email|exists:users,email'
            ]);

            if ($validater->fails())
            {
                return APIHelper::error(__('api/data.errors.requests.notValid'), ['errors'=>$validater->errors()]);
            }

            $user = User::where('email','=',$request->input('email'))->first();
            $verification = $user->verifications()->where('verifyFor','=',strtolower($type))->first();
            if ($verification!==NULL)
            {
                \Mail::to($user)->send((new verify($verification)));
                return APIHelper::jsonRender('Verification Email Sent Successfully', []);
            }

            return APIHelper::error('There Is No '.$type.' verification record for this email address');
        }

        public function login(LoginRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }
            $credentials = request(['email', 'password']);

            if(!Auth::attempt($credentials))
            {
                $user = User::where('email','=',$request->input('email'))->first();
                if ($user!==null&&$user->password===null && ($user->facebook_id!==null || $user->google_id!==null)) return APIHelper::jsonRender('Try Logging in Using Social Media Buttons', [], 400);
                return APIHelper::jsonRender('Username Or Password is wrong', [], 401);
            }

            $user = $request->user();

            if ($user->hasVerifiedEmail())
            {
                $reset = PasswordReset::where('email','=',$user->email)->first();
                if ($reset!==null)
                    $reset->delete();

                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;

                if ($request->input('remember_me'))
                    $token->expires_at = Carbon::now()->addWeeks(1);

                $token->save();
                $request->user()->makeHidden(['email_verified_at','backup_email_verified_at','phone_verified_at','backup_phone_verified_at','id_verified_at','is_hidden','is_closed']);

                return APIHelper::jsonRender('Successfully logged in', [
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString(),
                    'user'  => $request->user()->load(['links','verifyAssets'])
                ]);
            }

            return APIHelper::error('you need to verify your Primary email first');
        }
        public function loginByFacebook(SignupByRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }
            try {
                $response = $this->client->get(env('FACEBOOK_SERVICE_GRAPH_URL').'?access_token='.$request->input('token').'&fields=last_name,first_name,id,email');
                $response = json_decode($response->getBody()->getContents());

                $user = User::where('facebook_id','=',$response->id)->first();
                if ($user!==null)
                {
                    Auth::login($user);
                    $user = $request->user();
                    $tokenResult = $user->createToken('Personal Access Token');
                    $token = $tokenResult->token;
                    $token->save();

                    return APIHelper::jsonRender('Successfully logged in', [
                        'access_token' => $tokenResult->accessToken,
                        'token_type' => 'Bearer',
                        'expires_at' => Carbon::parse(
                            $tokenResult->token->expires_at
                        )->toDateTimeString(),
                        'user'  => $request->user()->load(['links','verifyAssets'])
                    ]);
                }
                return APIHelper::error('There Is No Registration For This Account', []);
            }catch (ClientException $e)
            {
                return APIHelper::jsonRender('Please Provide A Valid Access Token',[],403);
            }catch (ConnectException $e)
            {
                return APIHelper::jsonRender('Sorry ,Error On Out Side', [], 401);
            }
        }
        public function loginByGoogle(SignupByRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }
            try {
                $response = $this->client->get(env('GOOGLE_SERVICE_GRAPH_URL').'?access_token='.$request->input('token'));
                $response = json_decode($response->getBody()->getContents());

                $user = User::where('google_id','=',$response->sub)->first();
                if ($user!==null)
                {
                    Auth::login($user);
                    $user = $request->user();
                    $tokenResult = $user->createToken('Personal Access Token');
                    $token = $tokenResult->token;
                    $token->save();

                    return APIHelper::jsonRender('Successfully logged in', [
                        'access_token' => $tokenResult->accessToken,
                        'token_type' => 'Bearer',
                        'expires_at' => Carbon::parse(
                            $tokenResult->token->expires_at
                        )->toDateTimeString(),
                        'user'  => $request->user()->load(['links','verifyAssets'])
                    ]);
                }
                return APIHelper::error('There Is No Registration For This Account', []);
            }catch (ClientException $e)
            {
                return APIHelper::jsonRender('Please Provide A Valid Access Token',[],403);
            }catch (ConnectException $e)
            {
                return APIHelper::jsonRender('Sorry ,Error On Out Side', [], 401);
            }
        }

        public function forget(ForgetRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            $user  = User::where('email', '=', $request->input('email'))->first();
            if ($user!==null)
            {
                $reset = PasswordReset::where('email','=',$request->input('email'))->first();
                if ($reset===null)
                {
                    $reset = new PasswordReset(['email' =>  $request->input('email'),'token'    =>  Hash::make(\Str::random(15))]);
                    $reset->save();
                }

                \Mail::to($user)->send((new reset($reset)));
                return APIHelper::jsonRender('We\'ve Sent You Email To Verify', []);
            }else
                return APIHelper::error('No Account With This Email Yet');
        }
        public function reset(ResetRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            $reset = PasswordReset::where('token','=',$request->input('hash'))->first();
            if ($reset!==null)
            {
                $user = User::where('email','=',$reset->email)->first();
                $user->password = Hash::make($request->input('new_password'));

                if ($user->save())
                {
                    $reset->delete();
                    return APIHelper::jsonRender('New Password Saved Successfully', $user);
                }else
                    return APIHelper::error('Error Saving New Password, Try Again Please');
            }

            return APIHelper::error('Please Provide A Valid Hash Token For This Request');
        }

        public function logout(Request $request)
        {
            $request->user()->token()->revoke();
            return APIHelper::jsonRender('Successfully logged out', []);
        }

        public function user()
        {
            $user = \request()->user()->load(['links','verifyAssets','packages']);
            $user->facebook_login = $user->facebook_id??false;
            $user->google_login = $user->google_id??false;
            unset($user->is_closed,$user->is_hidden,$user->google_id,$user->facebook_id);
            return APIHelper::jsonRender('', $user);
        }

        public function userSettings()
        {
            return APIHelper::jsonRender('', \request()->user()->settings);
        }
    }
