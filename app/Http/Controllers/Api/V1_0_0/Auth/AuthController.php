<?php

    /// TODO: Read This Shit And Finish It (with translation)
    namespace App\Http\Controllers\Api\V1_0_0\Auth;

    use App\Helpers\APIHelper;
    use App\Http\Requests\LoginRequest;
    use App\Http\Requests\SignupByRequest;
    use App\Http\Requests\SignupRequest;
    use App\Http\Requests\VerifyRequest;
    use App\Mail\signup;
    use App\Mail\Verified;
    use App\Mail\verify;
    use App\Models\Newsletter;
    use GuzzleHttp\Exception\ClientException;
    use GuzzleHttp\Exception\ConnectException;
    use Hash;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Support\Facades\Validator;

    class AuthController extends Controller
    {
        public function signup(SignupRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            $user = new User([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
            $user->save();
            \Mail::to($user)->send(new signup());

            $verification = $user->verifications()->create([
                'verifyFor' =>  'email',
                'verifyCode'=>  \Str::random(8),
            ]);
            \Mail::to($user)->send(new verify($verification));

            if ($request->input('newsletter_subscribe'))
            {
                if (Newsletter::where('email','=',$request->input('email'))->get()->first() === null)
                {
                    $newsletter = new Newsletter([
                        'email' =>  $request->input('email'),
                    ]);
                    $newsletter->save();
                }
            }

            return APIHelper::jsonRender('Successfully created user!', $user, 201);
        }
        public function signupByFacebook(SignupByRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }
            try {
                $response = $this->client->get(env('FACEBOOK_SERVICE_GRAPH_URL').'?access_token='.$request->input('token').'&fields=last_name,first_name,id,email');
                $response = json_decode($response->getBody()->getContents());

                if (User::where('facebook_id','=',$response->id)->get()->first()===null)
                {
                    $user = User::where('email','=',$response->email)->get()->first();
                    if ($user===NULL)
                    {
                        $user = new User();
                        $user->firstname = $response->first_name;
                        $user->lastname = $response->last_name;
                        $user->email = $response->email;
                        $user->email_verified_at = now();

                        $response = $this->client->get(env('FACEBOOK_SERVICE_GRAPH_URL').'/picture?access_token='.$request->input('token').'&height=720&redirect=0');
                        $response = json_decode($response->getBody()->getContents())->data;
                        $img = uniqid('user_', true).'.jpeg';
                        file_put_contents('images/users/'.$img, file_get_contents($response->url));
                        $user->img = $img;
                    }
                    $user->facebook_id = $response->id;
                    if ($user->save())
                    {
                        return APIHelper::jsonRender('Successfully created user!', $user, 201);
                    }

                    return APIHelper::error('error creating user', []);
                }

                return APIHelper::error('There is a user already registered with this account', []);
            }catch (ClientException $e)
            {
                return APIHelper::jsonRender('Please Provide A Valid Access Token',[],403);
            }catch (ConnectException $e)
            {
                return APIHelper::jsonRender('Sorry ,Error On Out Side', [], 401);
            }
        }
        public function signupByGoogle(SignupByRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            try {
                $response = $this->client->get(env('GOOGLE_SERVICE_GRAPH_URL').'?id_token='.$request->input('token'));
                $response = json_decode($response->getBody()->getContents());

                if (User::where('google_id','=',$response->sub)->get()->first()===null)
                {
                    $user = User::where('email','=',$response->email)->get()->first();
                    if ($user===null)
                    {
                        $user = new User();
                        $user->firstname = $response->given_name;
                        $user->lastname = $response->family_name;
                        $user->email = $response->email;
                        $user->email_verified_at = now();

                        $img = uniqid('user_', true).'.jpeg';
                        file_put_contents('images/users/'.$img, file_get_contents(str_replace('s96-c', 's200-c', $response->picture)));
                        $user->img = $img;
                    }
                    $user->google_id = $response->sub;
                    if ($user->save())
                    {
                        return APIHelper::jsonRender('Successfully created user!', $user, 201);
                    }

                    return APIHelper::error('error creating user', []);
                }
                return APIHelper::error('There is a user already registered with this account', []);
            }catch (ClientException $e)
            {
                return APIHelper::jsonRender('Please Provide A Valid Access Token',[],403);
            }catch (ConnectException $e)
            {
                return APIHelper::jsonRender('Sorry ,Error On Out Side', [], 401);
            }
        }

        public function verify(VerifyRequest $request,$type)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            $user = User::where('email','=',$request->input('email'))->get()->first();

            if ($user->{strtolower($type).'_verified_at'}===NULL)
            {
                $verification = $user->verifications()->where('verifyFor','=',strtolower($type))->get()->first();
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

            $user = User::where('email','=',$request->input('email'))->get()->first();
            $verification = $user->verifications()->where('verifyFor','=',strtolower($type))->get()->first();
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
                return APIHelper::jsonRender('Unauthorized', [], 401);

            $user = $request->user();

            if ($user->hasVerifiedEmail())
            {
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;

                if ($request->input('remember_me'))
                    $token->expires_at = Carbon::now()->addWeeks(1);

                $token->save();

                return APIHelper::jsonRender('Successfully logged in', [
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString(),
                    'user'  => $request->user()
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

                $user = User::where('facebook_id','=',$response->id)->get()->first();
                if ($user!==null)
                {
                    Auth::login($user);
                    $user = $request->user();
                    if ($user->hasVerifiedEmail())
                    {
                        $tokenResult = $user->createToken('Personal Access Token');
                        $token = $tokenResult->token;
                        $token->save();

                        return APIHelper::jsonRender('Successfully logged in', [
                            'access_token' => $tokenResult->accessToken,
                            'token_type' => 'Bearer',
                            'expires_at' => Carbon::parse(
                                $tokenResult->token->expires_at
                            )->toDateTimeString(),
                            'user'  => $request->user()
                        ]);
                    }

                    return APIHelper::error('you need to verify your Primary email first');
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
                $response = $this->client->get(env('GOOGLE_SERVICE_GRAPH_URL').'?id_token='.$request->input('token'));
                $response = json_decode($response->getBody()->getContents());

                $user = User::where('google_id','=',$response->sub)->get()->first();
                if ($user!==null)
                {
                    Auth::login($user);
                    $user = $request->user();
                    if ($user->hasVerifiedEmail())
                    {
                        $tokenResult = $user->createToken('Personal Access Token');
                        $token = $tokenResult->token;
                        $token->save();

                        return APIHelper::jsonRender('Successfully logged in', [
                            'access_token' => $tokenResult->accessToken,
                            'token_type' => 'Bearer',
                            'expires_at' => Carbon::parse(
                                $tokenResult->token->expires_at
                            )->toDateTimeString(),
                            'user'  => $request->user()
                        ]);
                    }

                    return APIHelper::error('you need to verify your Primary email first');
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

        public function logout(Request $request)
        {
            $request->user()->token()->revoke();
            return APIHelper::jsonRender('Successfully logged out', []);
        }
    }
