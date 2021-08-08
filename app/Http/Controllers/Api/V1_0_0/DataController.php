<?php


    namespace App\Http\Controllers\Api\V1_0_0;

    use App\Helpers\APIHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\ContactRequest;
    use App\Models\Category;
    use App\Models\ClientComment;
    use App\Models\Contact;
    use App\Models\ContactMessage;
    use App\Models\Package;
    use App\Models\Subcategory;
    use App\Models\TermsOfUse;
    use Illuminate\Http\Request;

    class DataController extends Controller
    {
        public function termsandconditions()
        {
            $data = TermsOfUse::select('term as name', 'data_' . self::$language . ' as data', 'updated_at as last_modified')->where('term', 'terms')->first();
            return APIHelper::jsonRender('', $data);
        }

        public function privacy()
        {
            $data = TermsOfUse::select('term as name', 'data_' . self::$language . ' as data', 'updated_at as last_modified')->where('term', 'privacy')->first();
            return APIHelper::jsonRender('', $data);
        }

        public function packages()
        {
            $data = Package::select('id','name_'.self::$language.' as name', 'details_'.self::$language.' as details','price','duration','dur as quantity')->latest()->get();
            return APIHelper::jsonRender('', $data);
        }

        public function categories()
        {
            $data = Category::select('id','name_'.self::$language.' as name')->latest()->with('subcategories')->get();
            return APIHelper::jsonRender('', $data);
        }

        public function subcategories(Category $category)
        {
            if (!$category->exists)
            {
                $data = Subcategory::select('id','name_'.self::$language.' as name', 'category_id')->with('category:id,name_'.self::$language.' as name')->get();
            }else
            {
                $data = $category->subcategories()->select('id','name_'.self::$language.' as name')->get();
            }

            return APIHelper::jsonRender('', $data);
        }

        public function comments()
        {
            $data = ClientComment::select('id','name_'.self::$language.' as name','comment_'.self::$language.' as comment')->latest()->get();
            return APIHelper::jsonRender('', $data);
        }

        public function version()
        {
            preg_match('/V(\d_?)+/', __NAMESPACE__,$matches);
            return APIHelper::jsonRender('', [
                'current_version'   =>  str_replace('_','.',$matches[0]),
                'latest_version'    =>  APIHelper::getVersion(config('app.api_latest')),
                'allowed_versions'  =>  APIHelper::getAllowedVersions()
            ]);
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
    }
