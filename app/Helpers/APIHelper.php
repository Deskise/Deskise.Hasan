<?php


    namespace App\Helpers;


    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Support\Facades\App;
    use Mcamara\LaravelLocalization\LaravelLocalization;
    use phpDocumentor\Reflection\Types\Parent_;

    class APIHelper
    {
        // versioning:
        protected static $defaultApiNamespace='App\Http\Controllers\Api';
        public static function getVersion($version, &$prefix=Null, &$namespace=Null, $customNamespace=Null)
        {
            if ($version[0] === 'v')
            {
                $version = ltrim($version,'v');
            }

            $version = explode('.',$version);
            $prefix = 'api/v'.$version[0];

            for ($i=1;$i<3;$i++)
            {
                if (!isset($version[$i]))
                {
                    $version[$i] = 0;
                }else {
                    $prefix.='.'.$version[$i];
                }
            }
            $version = 'v'.implode('.',$version);

            if ($customNamespace === NULL)
            {
                $customNamespace = self::$defaultApiNamespace;
            }

            $namespace = "{$customNamespace}\\".str_replace('.','_',strtoupper($version));
            return strtolower($version);
        }
        public static function getAllowedVersions()
        {
            $versions = [];
            foreach (explode(',', env('API_ALLOWED_VERSIONS')) as $ver)
            {
                $versions[] = self::getVersion($ver);
            }

            return $versions;
        }

        public static function notification(User $to, $title, $body, $data=[])
        {
            // $data must be an array of key=>value pairs
            return \Http::withHeaders(['Authorization' => 'key='.env('FIREBASE_SERVER_KEY')])
                ->post('https://fcm.googleapis.com/fcm/send',[
                    "registration_ids" => [$to->FToken],
                    "notification" => [
                        "title" => $title,
                        "body" => $body,
                    ],
                    'data'  =>  $data
                ]);
        }

        public static function mustHaveHeader($header,$val, $next, \Closure $callback=Null)
        {
            if (request()->hasHeader($header))
            {
                if (is_array($val))
                {
                    if (!in_array(request()->header($header), $val, true))
                    {
                        return self::error(__('api/data.errors.headers.noMatch.array',['name'=>$header,'values'=>implode(', ', $val)]));
                    }
                }else{
                    if (strtolower(request()->header($header))!==strtolower($val))
                    {
                        return self::error(__('api/data.errors.headers.noMatch.str',['name'=>$header,'value'=>$val]));
                    }
                }
            }else{
                return self::error(__('api/data.errors.headers.notProvided',['name'=>$header]));
            }
            if ($callback!==Null)
            {
                $callback(request()->header($header));
            }
            return $next(request());
        }

        public static function error($message, $data=[])
        {
            return self::jsonRender($message, $data,400);
        }
        public static function jsonRender($message,$data,$code=200, array $more=[])
        {
            if(!$data instanceof \Illuminate\Database\Eloquent\Collection && !is_array($data)) $data = [$data];
            return response()->json([
                'response'  =>  array_merge([
                    'message'   =>  $message?:NULL,
                    'extra'      =>  $data?:NULL
                ],$more),
                'content-language'  =>  App::getLocale(),
                'code'              =>  $code
            ], $code);
        }

        public static function getLangFrom($str)
        {
            $str = explode(',', $str);
            $arr = [];

            foreach ($str as $item)
            {
                foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
                {
                    $arr[] = $item.'_'.$lang;
                }
            }

            return $arr;
        }

        public static function getImageUrl($for,$image)
        {
            return route('images',['for'=>$for,'image'=>$image]);
        }

        // public static function getImageUrl($for, $image)
        // {
        //     // Construct the URL with 'backend/' prefix
        //     return route('images', ['for' => 'backend/' . $for, 'image' => $image]);
        // }


        public static function getSimilar($class,$select='*',$num=8)
        {
            return $class::select($select)->inRandomOrder()->paginate($num);
        }
    }
