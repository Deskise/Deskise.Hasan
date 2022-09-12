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
    use Carbon\Carbon;
    use Carbon\CarbonPeriod;
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
            return APIHelper::jsonRender('', Product::select('id','name', 'summary as details','price',
                'special','verified', 'img','status')
                ->where('status','!=','under_verify')
                ->where('status','!=','canceled')->paginate(4));
        }

        public function list($category=false)
        {
            $query = $this->filter(
                Product::select('id','name', 'summary as details','price',
                    'special','verified', 'img','status','is_lifetime','until','created_at','user_id')
                    ->where('status','!=','under_verify')
                    ->where('status','!=','canceled')
                    ->orderBy('id','desc')
            );

            if (is_a($query, JsonResponse::class))
                return $query;

            if ($category)
                $query->where('category_id', $category);

            $page = $query->paginate(12);
            return APIHelper::jsonRender('', [[
                'current_page' => $page->currentPage(),
                'next_page_url' =>  $page->nextPageUrl(),
                'data'=>$page->map(function (Product $q) {
                    $q->subcategory = $q->data->subcategory->{'name_'.self::$language};
                    $q->views = round($q->views()->count() / CarbonPeriod::create($q->created_at, '1 month', Carbon::now())->count(),2);
                    $q->seller_location = $q->user->location;
                    unset($q->data, $q->user);
                    return $q;
                })
            ]]);
        }

        public function single($id, $prod=false)
        {
            $user=request()->user('api');
            $product = Product::select('id','name', 'summary as summary','description','price','user_id','img', 'special','verified','status','is_lifetime','until', 'category_id', 'updated_at', 'created_at')
                ->with('user:id,firstname,lastname,img,is_hidden')
                ->with('data')
                ->with('data.subcategory:id,name_'.self::$language . ' as name')
                ->with('social.account:id,name_'.self::$language.' as name,description_'.self::$language.' as description')
                ->with('assets')
                ->find($id);

            if ($product===Null) return APIHelper::jsonRender('Requested Product Not Found', [], 404);
            if ($product->status === 'canceled'  && $product->user_id!==$user->id)
                return APIHelper::jsonRender('Requested Product Has Been Cancelled', [], 403);
            if ($product->status === 'under_verify' && ($user===null || $product->user_id!==$user->id))
                return APIHelper::jsonRender('Requested Product Still Under verification', [], 403);

            $product->views()->create(['visitor_id'=>request()?->user('api')->id]);
            $bought = $product->bought();
            $product->bought = ['count' => $bought->count(), 'user_imgs' => $bought->limit(5)->get()->each(function($buy){
                $user = User::find($buy->user_id);
                unset($buy->id,$buy->product_id);
                $buy->img = $user->img;
                $buy->name = $user->firstname.' '.$user->lastname;
            })];

            $product->likes = $product->likes()->count();
            if ($user) {
                $product->liked = $product->likes()->where('user_id', '=', $user->id)->first() !== null;
                $product->mine = ($product->user_id===$user->id);
            }
            $product->dates = ['new'=>$product->updated_at, 'old'=>$product->created_at];
            if ($product->user->is_hidden && !$product->mine) {
                unset($product->user);
                $product->user=null;
            }

            unset($product->user_id,$product->subcategory_id);
            if ($prod) return $product;

            return APIHelper::jsonRender('', $product);
        }

        public function like(Product $product)
        {
            if ($product->status === 'canceled'  && $product->user_id !== request()->user('api')->id)
                return APIHelper::jsonRender('Requested Product Has Been Cancelled', [], 403);
            if ($product->status === 'under_verify' && $product->user_id !== request()->user('api')->id)
                return APIHelper::jsonRender('Requested Product Still Under verification', [], 403);

            if (is_null($like=ProductLikes::where('product_id','=',$product->id)->where('user_id','=',request()->user('api')->id)->first()))
            {
                if ($product->likes()->create([
                    'user_id'   =>  request()->user('api')->id
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
            if (($validator=\Validator::make(request()->all(), ['q'=>'required|string']))->fails())
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

            if (is_a($query, JsonResponse::class)) return $query;
            if ($category) $query->where('category_id', $category);

            return APIHelper::jsonRender('', $query->paginate(12));
        }

        public function edit($id=false)
        {
            $product = $this->single($id, true);

            if ($product->status === 'canceled'  && $product->user_id !== request()->user('api')->id)
                return APIHelper::jsonRender('Requested Product Has Been Cancelled', [], 403);

            if ($product->status === 'under_verify' && $product->user_id !== request()->user('api')->id)
                return APIHelper::jsonRender('Requested Product Still Under verification', [], 403);

            if (is_a($product, JsonResponse::class))
                return $product;

            $product->draft = $product->drafts()->first();
            return APIHelper::jsonRender('', $product);
        }
        public function publish(ProductEditRequest $request, $id=false)
        {
            if ($request->hasError) return $request->response;

            if ($id) {
                if (!$product=Product::find($id)) return APIHelper::jsonRender('The Requested Product Not Found', [], 404);
            } else $product = new Product(['user_id' => $request->user('api')->id]);

            if (($draft=$product->drafts()->first())!==null) $draft->delete();

            $product->name = $request->input('name') ?? $product->name;
            $product->description = $request->input('description') ?? $product->description;
            $product->summary = $request->input('summary') ?? $product->summary;
            $product->price = $request->input('price') ?? $product->price;
            $product->img = $request->input('img') ?? $product->img;
            $product->is_lifetime = $request->input('lifetime') ?? $product->is_lifetime;
            $product->verified= true;

            if (\Route::currentRouteName()==='add' && $request->input('category'))
                $product->category_id = $request->input('category');

            if (!$product->is_lifetime)
                $product->until=date('Y-m-d',strtotime($request->input('until')))??$product->until;

            if (!$product->save())
                return APIHelper::error('Error Updating Data');

            if ($request->input('assets'))
                $product->assets()->update(['assets' => $request->input('assets')]);

            if ($request->input('subcategory') && $product->category->subcategories()->find($request->input('subcategory')))
                $product->data()->update(['subcategory_id' => ($request->input('subcategory')?? $product->data->subcategory_id)]);
            else return APIHelper::error('Subcategory_id Provided Is Not Subcategory for this category');

            if ($request->input('data'))
                if (($v=\Validator::make($data=json_decode($request->input('data'),true),$product->category->validateData()))->fails())
                    return APIHelper::error($v->errors()->first(),$v->errors());
                else $product->data()->update(['data' => $product->category->bindValues($data)]);

            if ($request->input('packages'))
            {
                foreach ($packages=json_decode($request->input('packages'), true, 512, JSON_THROW_ON_ERROR) as $package_id)
                    ($product->packages()->where('package_id', '=', $package_id)->first() ?? $product->packages()->create(['status' => 'attached','package_id' => $package_id]));
                $product->packages()->whereNotIn('package_id',$packages)->delete();
            }

            if ($request->input('social_media'))
            {
                foreach ($items=json_decode($request->input('social_media'), true, 512, JSON_THROW_ON_ERROR) as $item)
                    $product->social()->updateOrCreate(['social_id' => $item['id']],['link' => $item['link']]);
                $product->social()->whereNotIn('social_id',collect($items)->pluck('id'))->delete();
            }
            return APIHelper::jsonRender('Data Updated Successfully', $this->single($product->id,true));
        }
        public function saveDraft(ProductEditRequest $request, $id=0)
        {
            if ($request->hasError)return $request->response;

            $product=ProductDraft::find($id)->first()??new ProductDraft();

            $product->product_id = $request->input('product_id');
            $product->user_id = $request->user('api')->id;
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->summary = $request->input('summary');
            $product->price = $request->input('price');
            $product->category_id = $request->input('category');
            $product->img = $request->input('img');
            $product->is_lifetime = $request->input('lifetime');
            $product->assets = json_decode($request->input('assets'));
            $product->subcategory_id = $request->input('subcategory');
            $product->packages = json_decode($request->input('packages'));
            $product->socialLinks = json_decode($request->input('social_media'));

            if (!$product->is_lifetime)
                $product->until=date('Y-m-d',strtotime($request->input('until')));

            if (($v=\Validator::make($data=json_decode($request->input('data'),true),$product->category->validateData(false)))->fails())
                return APIHelper::error($v->errors()->first(),$v->errors());
            else $product->data = $product->category->bindValues($data);

            if (!$product->save())
                return APIHelper::error('Error Updating Data');

            return APIHelper::jsonRender('Data Updated Successfully', $product);
        }
        public function upload(Request $request)
        {
            if (($validator=\Validator::make($request->all(), [
                'file'  =>  'required|file|mimes:png,jpg,jpeg,webp,svg'
            ]))->fails())
                return APIHelper::jsonRender('There Was An Error Validating Your Request', $validator->errors(), 400);

            $file=new \stdClass();
            $request->file('file')?->storeAs('products/'.$request->user('api')->id,
                $file->name=time().'_#'.$request->user('api')->id.'_'.\Str::random(10).'.'.$request->file('file')?->getClientOriginalExtension(),
                'public');

            return APIHelper::jsonRender('Uploaded Successfully', $file);
        }

        public function verify($id)
        {

        }
    }
