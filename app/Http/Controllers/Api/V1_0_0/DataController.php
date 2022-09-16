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
        public function products(User $user)
        {
            $products = $user->products()->select('id','name_'.self::$language.' as name', 'summary_'.self::$language.' as details','price',
                'special','verified', 'img','status');
            if (!\Auth::user() || \Auth::user()->id !== $user->id)
                $products->where('status','!=','under_verify')
                    ->where('status','!=','canceled');

            return APIHelper::jsonRender('',[$products->paginate(5)]);
        }
    }
