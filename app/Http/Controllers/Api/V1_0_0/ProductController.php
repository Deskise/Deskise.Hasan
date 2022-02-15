<?php


    namespace App\Http\Controllers\Api\V1_0_0;

    use App\Helpers\APIHelper;
    use App\Http\Controllers\Api\V1_0_0\traits\ProductFilter;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Product\ProductEditRequest;
    use App\Http\Requests\ProductRequest as ProdRequest;
    use App\Models\Category;
    use App\Models\Newsletter;
    use App\Models\Product;
    use App\Models\ProductDraft;
    use App\Models\ProductLikes;
    use App\Models\ProductRequest;
    use App\Models\Subcategory;
    use App\Models\User;
    use Faker\Generator;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class ProductController extends Controller
    {
        use ProductFilter;
        public function __construct()
        {
            $this->middleware('auth:api')->except(['request','list','best','search', 'single']);
        }

        public function request(ProdRequest $request)
        {
            if ($request->hasError)
                return $request->response;

            $categoryId = (int)$request->input('category');
            $subcategoryId = (int)$request->input('subcategory');

            $subcategory = Subcategory::find($subcategoryId);
            if ($subcategory->category_id !== $categoryId)
            {
                ///TODO: Translate and rephrase this shit
                return APIHelper::error('Subcategory Requested Is Not For the Requested Category');
            }

            $productRequest = new ProductRequest();
            $productRequest->category_id = $categoryId;
            $productRequest->subcategory_id = $subcategoryId;
            $productRequest->email = $request->input('email');
            $productRequest->ePrice = $request->input('price');
            $productRequest->details = $request->input('message');

            if (!$productRequest->save())
            {
                ///TODO: Translate and rephrase this shit
                return APIHelper::error('Error Saving Product');
            }

            if ($request->input('sendEmails'))
            {
                $newslatter = new Newsletter();
                $newslatter->email = $request->input('email');
                if (!$newslatter->save())
                {
                    ///TODO: Translate and rephrase this shit
                    return APIHelper::error('Error Adding User To The Newsletter');
                }
            }

            return APIHelper::jsonRender(__('api/data.products.request.success'), $productRequest);
        }
        public function best()
        {
            ///TODO: Get Packages Data and Things And find a way to get the pinned ones here to show on the homepage
            return APIHelper::jsonRender('', Product::paginate(10));
        }

        public function list($category=false)
        {

            $query = $this->filter(
                Product::select('id','name_'.self::$language.' as name', 'summary_'.self::$language.' as details','price',
                    'special','verified', 'img','status')
                    ->where('status','!=','under_verify')
                    ->where('status','!=','canceled')
            );

            if (is_a($query, JsonResponse::class))
                return $query;

            if ($category)
                $query->where('category_id', $category);

            return APIHelper::jsonRender('', $query->paginate(12));
        }

        public function single($id, $prod=false)
        {
            $product = Product::select('id','name_'.self::$language.' as name', 'summary_'.self::$language.' as summary',
                'description_'.self::$language.' as description','price','user_id','img', 'special','verified','status','is_lifetime','until')
                ->with('user:id,firstname,lastname,img,is_hidden')
                ->with('data')
                ->with('data.subcategory:id,name_'.self::$language . ' as name')
                ->with('social.account:id,name_'.self::$language.' as name,description_'.self::$language.' as description')
                ->with('assets')
                ->find($id);

            if ($product===Null)
                return APIHelper::jsonRender('Requested Product Not Found', [], 404);

            if ($product->status === 'canceled'  && $product->user_id !== request()->user()->id)
                return APIHelper::jsonRender('Requested Product Has Been Cancelled', [], 403);

            if ($product->status === 'under_verify' && (request()->user() === null || $product->user_id !== request()->user()->id))
                return APIHelper::jsonRender('Requested Product Still Under verification', [], 403);

            $bought = $product->bought();
            $product->bought = ['count' => $bought->count(), 'user_imgs' => $bought->limit(5)->get()->each(function($buy){
                $user = User::find($buy->user_id);
                unset($buy->id,$buy->product_id);
                $buy->img = $user->img;
                $buy->name = $user->firstname.' '.$user->lastname;
            })];

            $product->likes = $product->likes()->count();
            if (\request()->user()) {
                $product->liked = $product->likes()->where('user_id', '=', request()->user()->id)->first() !== null;
                $product->mine = ($product->user_id===request()->user()->id);
            }else{
                if ($product->user->is_hidden)
                {
                    $person = new \Faker\Provider\en_US\Person(new Generator());

                    $product->user->firstname = $person->firstName($person::GENDER_MALE);
                    $product->user->lastname = $person->lastname();
                    $product->user->img = 'default.png';
                }
            }

            unset($product->user_id,$product->category_id,$product->subcategory_id);
            if ($prod) return $product;

            return APIHelper::jsonRender('', $product);
        }

        public function like(Product $product)
        {
            if ($product->status === 'canceled'  && $product->user_id !== request()->user()->id)
                return APIHelper::jsonRender('Requested Product Has Been Cancelled', [], 403);

            if ($product->status === 'under_verify' && $product->user_id !== request()->user()->id)
                return APIHelper::jsonRender('Requested Product Still Under verification', [], 403);

            $like = ProductLikes::where('product_id','=',$product->id)->where('user_id','=',request()->user()->id)->first();

            if ($like===null)
            {
                if ($product->likes()->create([
                    'user_id'   =>  request()->user()->id
                ]))
                    return APIHelper::jsonRender('Product Liked Successfully', []);

                return APIHelper::error('Error Liking Product, Try Again Later');
            }
            if ($like->delete())
                return APIHelper::jsonRender('Product Disliked Successfully', []);

            return APIHelper::error('Error Disliking Product, Try Again Later');
        }

        public function search($category=false)
        {
            $validator = \Validator::make(request()->all(), ['q'=>'required|string']);
            if ($validator->fails())
                return APIHelper::error('there were some errors with the request',$validator->errors());

            $query = $this->filter(
                Product::select('id','name', 'summary','price',
                    'special','verified','category_id', 'user_id')
                    ->with('category:id,name_'.self::$language.' as name')
                    ->with('data:id,subcategory_id')
                    ->with('data.subcategory:id,name_'.self::$language.' as name')
                    ->where(function ($query) {
                        $query  ->where('status','!=','under_verify')
                                ->where('status','!=','canceled');
                    })->where(function ($query) {
                        $q = request('q');
                        $query  ->where('name', 'like', "%$q%")
                                ->orWhere('description', 'like', "%$q%")
                                ->orWhere('summary', 'like', "%$q%");
                    })
            );

            if (is_a($query, JsonResponse::class))
                return $query;

            if ($category)
                $query->where('category_id', $category);

            return APIHelper::jsonRender('', $query->paginate(12));
        }

        public function edit($id=false)
        {
            $product = $this->single($id, true);

            if ($product->status === 'canceled'  && $product->user_id !== request()->user()->id)
                return APIHelper::jsonRender('Requested Product Has Been Cancelled', [], 403);

            if ($product->status === 'under_verify' && $product->user_id !== request()->user()->id)
                return APIHelper::jsonRender('Requested Product Still Under verification', [], 403);

            if (is_a($product, 'Illuminate\Http\JsonResponse'))
                return $product;

            $product->draft = $product->draft()->first();
            return APIHelper::jsonRender('', $product);
        }
        public function publish(ProductEditRequest $request, $id=false)
        {
            if ($request->hasError)
                return $request->response;

            if ($id) {
                $product = Product::find($id);
                if (!$product)
                {
                    return APIHelper::jsonRender('The Requested Product Not Found',[],404);
                }
            } else {
                $product = new Product();
                $product->user_id = $request->user()->id;
            }

            $draft = $product->draft()->first();
            if ($draft!==null) $draft->delete();

            $product->name = $request->input('name') ?? $product->name;
            $product->description = $request->input('description') ?? $product->description;
            $product->summary = $request->input('summary') ?? $product->summary;
            $product->price = $request->input('price') ?? $product->price;
            $product->img = $request->input('img') ?? $product->img;
            $product->is_lifetime = $request->input('lifetime') ?? $product->is_lifetime;

            if (\Route::currentRouteName()==='add' && $request->input('category'))
            {
                $product->category_id = $request->input('category');
            }
            $category = Category::find($request->input('category')??$product->category());

            if (!$product->is_lifetime)
                $product->until = date('Y-m-d',strtotime($request->input('until'))) ?? $product->until;
            else
                $product->until = NULL;

            if (!$product->save())
            {
                return APIHelper::error('Error Updating Data');
            }

            if ($request->input('assets'))
            {
                $product->assets()->update(['assets' => $request->input('assets')]);
            }

            if ($request->input('subcategory') && $category->subcategories()->find($request->input('subcategory')))
            {
                $product->data()->update(['subcategory_id' => ($request->input('subcategory')?? $product->data()->get()->first()->subcategory_id)]);
            }else
            {
                return APIHelper::error('Subcategory_id Provided Is Not Subcategory for this category');
            }
            if ($request->input('data'))
            {
                $product->data()->update(['data' => $request->input('data')]);
            }
            if ($request->input('packages'))
            {
                $packages = json_decode($request->input('packages'), true, 512, JSON_THROW_ON_ERROR);
                $product->packages()->whereNotIn('package_id',$packages)->delete();

                foreach ($packages as $id)
                {
                    ($product->packages()->where('package_id', '=', $id)->first() ?? $product->packages()->create(['status' => 'attached','package_id' => $id]));
                }
            }
            if ($request->input('social_media'))
            {
                $social = json_decode($request->input('social_media'), true, 512, JSON_THROW_ON_ERROR);
                $ids = [];

                foreach ($social as $item)
                {
                    $ids[] = $item['id'];

                    $social = $product->social()->where('social_id','=',$item['id'])->first();
                    if ($social !== null) $social->update(['link' => $item['link']]);
                    else $product->social()->create(['social_id' => $item['id'], 'link' => $item['link']]);
                }
                $product->social()->whereNotIn('social_id',$ids)->delete();
            }

            return APIHelper::jsonRender('Data Updated Successfully', $this->single($product->id,true));
        }
        public function saveDraft(ProductEditRequest $request, $id=false)
        {
            if ($request->hasError)
                return $request->response;

            if ($id)
            {
                $product = ProductDraft::where('product_id','=',$id)->first();
                if (!$product)
                {
                    $product = new ProductDraft();
                    $product->user_id = $request->user()->id;
                    $product->product_id = $id;
                }
            }else
            {
                $product = new ProductDraft();
                $product->user_id = $request->user()->id;
            }

            $product->name = $request->input('name') ?? $product->name;
            $product->description = $request->input('description') ?? $product->description;
            $product->summary = $request->input('summary') ?? $product->summary;
            $product->price = $request->input('price') ?? $product->price;
            $product->category_id = $request->input('category') ?? $product->category_id;
            $product->img = $request->input('img') ?? $product->img;
            $product->is_lifetime = $request->input('lifetime') ?? $product->is_lifetime;

            if (!$product->is_lifetime)
                $product->until = date('Y-m-d',strtotime($request->input('until'))) ?? $product->until;
            else
                $product->until = NULL;

            $product->assets = json_decode($request->input('assets'));
            $product->subcategory_id = $request->input('subcategory');
            $product->data = json_decode($request->input('data'));
            $product->packages = json_decode($request->input('packages'));
            $product->socialLinks = json_decode($request->input('social_media'));

            if (!$product->save())
            {
                return APIHelper::error('Error Updating Data');
            }

            return APIHelper::jsonRender('Data Updated Successfully', $product);
        }
        public function upload(Request $request, $id=false)
        {
            $validator = \Validator::make($request->all(), [
                'file'  =>  'required|file|mimes:png,jpg,jpeg,webp,svg'
            ]);
            if ($validator->fails())
            {
                return APIHelper::jsonRender('There Was An Error Validating Your Request', $validator->errors(), 400);
            }
            $file = new \stdClass();

            $file->name = time().'_#'.$request->user()->id.'_'.\Str::random(10).'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('products/'.$request->user()->id, $file->name,'public');

            return APIHelper::jsonRender('Uploaded Successfully', $file);
        }

        public function verify($id)
        {

        }
    }
