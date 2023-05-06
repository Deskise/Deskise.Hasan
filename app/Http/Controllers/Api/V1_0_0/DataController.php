<?php


    namespace App\Http\Controllers\Api\V1_0_0;

    use App\Helpers\APIHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\ContactRequest;
    use App\Models\AboutUs;
    use App\Models\Category;
    use App\Models\ClientComment;
    use App\Models\Contact;
    use App\Models\ContactMessage;
    use App\Models\FAQ;
    use App\Models\Newsletter;
    use App\Models\Package;
    use App\Models\SocialMediaAccount;
    use App\Models\Subcategory;
    use App\Models\TermsOfUse;
    use App\Models\User;
    use Illuminate\Http\Request;
    use App\Models\Product;
    use Carbon\Carbon;
    use Carbon\CarbonPeriod;

    class DataController extends Controller
    {
        public function termsandconditions()
        {
            return APIHelper::jsonRender('', TermsOfUse::select('term as name', 'data_' . self::$language . ' as data', 'updated_at as last_modified')->where('term', 'terms')->first());
        }

        public function privacy()
        {
            return APIHelper::jsonRender('', TermsOfUse::select('term as name', 'data_' . self::$language . ' as data', 'updated_at as last_modified')->where('term', 'privacy')->first());
        }

        public function packages()
        {
            return APIHelper::jsonRender('', Package::select('id','name_'.self::$language.' as name', 'details_'.self::$language.' as details','price','duration','dur as quantity')->latest()->get());
        }

        public function categories(Category $category)
        {
            return APIHelper::jsonRender('', ($category->exists)?
                $category->load('subcategories:id,name_'.self::$language.' as name'):
                Category::latest()->with('subcategories:id,category_id,name_'.self::$language.' as name')->get()
            );
        }

        public function subcategories($category)
        {
            return APIHelper::jsonRender('', ['subcategories' => ((int)($category)!==0)?
                Subcategory::select('id','name_'.self::$language.' as name')->where('category_id',$category)->get():
                Subcategory::select('id','name_'.self::$language.' as name')->get()]
            );
        }

        public function comments()
        {
            $data = ClientComment::select('id','name_'.self::$language.' as name','comment_'.self::$language.' as comment','img')->orderBy('id','desc')->latest()->get();
            return APIHelper::jsonRender('', $data);
        }

        public function version()
        {
            preg_match('/V(\d_?)+/', __NAMESPACE__,$matches);
            $data = new \stdClass();
            $data->current_version  =  str_replace('_','.',$matches[0]);
            $data->latest_version   =  APIHelper::getVersion(config('app.api_latest'));
            $data->allowed_versions  =  APIHelper::getAllowedVersions();

            return APIHelper::jsonRender('', $data);
        }

        public function contact(ContactRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            $name = $request->input('name');
            $email = $request->input('email');
            $message = $request->input('message');

            $contact = Contact::where('email',$email)->get()->first();
            if ($contact===null) {
                $contact = new Contact(['name'=>$name,'email'=>$email]);
                $contact->save();
            }

            $comment = $contact->messages()->create([
                'message'   =>  $message
            ]);

            return APIHelper::jsonRender(__('api/data.contact.message.success'), [ContactMessage::with('contact')->find($comment->id)]);
        }

        public function faq()
        {
            $data = FAQ::select('id','question_'.self::$language.' as question','answer_'.self::$language.' as answer','updated_at as date')->paginate(25);
            return APIHelper::jsonRender('', $data);
        }

        public function news(Request $request)
        {
            $validator = \Validator::make(request()->all(), ['email' => 'required|email']);
            if ($validator->fails())
                return APIHelper::error('there were some errors with the request',$validator->errors());

            $newslettter = Newsletter::where('email','=',$request->input('email'))->first();
            if ($newslettter === null)
            {
                $newslettter = new Newsletter();
                $newslettter->email = $request->input('email');
                $newslettter->save();
            }
            return APIHelper::jsonRender('Thanks For Subscribing ', []);
        }

        public function aboutHome()
        {
            $data = AboutUs::select('home_'.self::$language.' as about','updated_at as last_modified')->get()->first();
            return APIHelper::jsonRender('', $data);
        }

        public function aboutPage()
        {
            $data = AboutUs::select('about_'.self::$language.' as about','updated_at as last_modified')->get()->first();
            return APIHelper::jsonRender('', $data);
        }

        public function social()
        {
            $data = SocialMediaAccount::select('id','name_'.self::$language.' as name','description_'.self::$language.' as description')->get();
            return APIHelper::jsonRender('', $data);
        }

        public function user($id)
        {
            return APIHelper::jsonRender('',User::find($id)->load('links'));
        }
        // public function products(User $user)
        // {
        //     $products = $user->products()->select('id','name_'.self::$language.' as name', 'summary_'.self::$language.' as details','price',
        //         'special','verified', 'img','status');
        //     if (!\Auth::user() || \Auth::user()->id !== $user->id)
        //         $products->where('status','!=','under_verify')
        //             ->where('status','!=','canceled');

        //     return APIHelper::jsonRender('',[$products->paginate(5)]);
        // }
        public function products(User $user)
        {
            $products = $user->products()->select('id','name', 'summary' ,'price', 'special','verified', 'img', 'status');
            if (!\Auth::user() || \Auth::user()->id !== $user->id)
                $products->where('status','!=','under_verify')
                    ->where('status','!=','canceled');

            return APIHelper::jsonRender('',[$products->paginate(5)]);
        }

        public function userProducts(User $user)
        {
            $productsQuery = $user->products()->select('id', 'created_at');

            if (!\Auth::user() || \Auth::user()->id !== $user->id) {
                $productsQuery->where('status', '!=', 'under_verify')
                    ->where('status', '!=', 'canceled');
            }
            $userProducts = $productsQuery->pluck('created_at', 'id');
            // $userProducts = $productsQuery->pluck('id', 'created_at');
            $userPackages = [];
            $prosuctsViews = [];
            foreach($userProducts as $userProduct => $id) {
                $userPackages[$userProduct] = Product::find($userProduct)->packages()->whereIn('product_id', [$userProduct])->get();
            }

            // Get the start date of the period
            $startDate = Carbon::parse($userProducts->values()->min());
            $endDate = Carbon::parse($userProducts->values()->max());
            
            // Generate an array of month-year pairs from the start date to the current month
            $endMonth = Carbon::now()->startOfMonth();
            $periods = [];
            $month = Carbon::parse($startDate)->startOfMonth();
            while ($month <= $endMonth) {
                $periods[] = $month->format('F Y');
                $month->addMonth();
            }
            
            // $monthlyViews = [];
            $periodViews = array_fill_keys($periods, 0);

            // Loop through the user's products and add up the views for each month
            foreach($userProducts as $userProduct => $created_at) {
                $viewsQuery = Product::find($userProduct)->views()->whereIn('product_id', [$userProduct])->get();
                
                foreach($periods as $period) {
                    $month = Carbon::createFromFormat('F Y', $period)->startOfMonth();
                    $views = $viewsQuery->whereBetween('created_at', [$month, $month->copy()->endOfMonth()])->count();
                    $periodViews[$period] += $views;
                }
            }

            // Calculate the total views for all months
            $totalViews = array_sum($periodViews);

            // foreach ($userProducts as $userProduct => $created_at) {
            //     $viewsQuery = $userProducts->values();
            //     // $viewsQuery = Product::find($userProduct)->views()->whereIn('product_id', [$userProduct]);
            //     // dd($viewsQuery);
            //     $productViews = [];
            //     foreach ($periods as $period) {
            //         $monthStart = Carbon::parse('1 ' . $period);
            //         $monthEnd = Carbon::parse('1 ' . $period)->endOfMonth();
            //         $viewsCount = $viewsQuery->whereBetween($viewsQuery, [$monthStart, $monthEnd])->count();
            //         $productViews[$period] = $viewsCount;
            //     }
            //     $monthlyViews = $productViews;
            // }
            
            foreach($userProducts as $userProduct => $created_at) {
                $prosuctsViews[$userProduct] = round(Product::find($userProduct)->views()->whereIn('product_id', [$userProduct])->count() / CarbonPeriod::create($created_at, '1 month', Carbon::now()->addMonths(6))->count(),2);
            }
            $responseData = [
                'userPackages' => $userPackages,
                'productsViews' => $prosuctsViews,
                'userProducts' => $userProducts,
                'periodViews' => $periodViews,
                'totalViews' => $totalViews,
            ];
            return APIHelper::jsonRender('', $responseData);
        }
        // public function userProducts(User $user)
        // {
        //     $productsQuery = $user->products()->select('id');

        //     if (!\Auth::user() || \Auth::user()->id !== $user->id) {
        //         $productsQuery->where('status', '!=', 'under_verify')
        //             ->where('status', '!=', 'canceled');
        //     }

        //     $userProducts = $productsQuery->pluck('id');

        //     $userPackages = [];
        //     $productsViews = [];
        //     foreach ($userProducts as $userProduct) {
        //         $userPackages[$userProduct] = Product::find($userProduct)->packages()->whereIn('product_id', [$userProduct])->get();
        //     }

        //     $period = CarbonPeriod::create()->addMonths(-6)->startOfMonth(); // get the last 6 months
        //     $viewsData = [];

        //     foreach ($period as $month) {
        //         $startDate = $month->startOfMonth()->toDateString();
        //         $endDate = $month->endOfMonth()->toDateString();

        //         $viewsData[$month->format('M Y')] = $userProducts->map(function ($productId) use ($startDate, $endDate) {
        //             return Product::find($productId)->views()->whereIn('product_id', [$productId])
        //                 ->whereBetween('created_at', [$startDate, $endDate])
        //                 ->count();
        //         })->avg();
        //     }

        //     $responseData = [
        //         'userPackages' => $userPackages,
        //         'productsViews' => $productsViews,
        //         'viewsData' => $viewsData,
        //     ];
        //     return APIHelper::jsonRender('', $responseData);
        // }


        

    }
