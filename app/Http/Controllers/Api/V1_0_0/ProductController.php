<?php


    namespace App\Http\Controllers\Api\V1_0_0;

    use App\Helpers\APIHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\ProductRequest as ProdRequest;
    use App\Models\Newsletter;
    use App\Models\Product;
    use App\Models\ProductRequest;
    use App\Models\Subcategory;

    class ProductController extends Controller
    {
        public function list()
        {
            ///TODO: Do This Shit

            return Product::select('id','name_'.self::$language.' as name', 'description_'.self::$language.' as description','price','special','verified','category_id','subcategory_id')
                ->with('category:id,name_'.self::$language.' as name')
                ->with('subcategory:id,name_'.self::$language.' as name')
                ->paginate(25);
        }

        public function request(ProdRequest $request)
        {
            if ($request->hasError)
            {
                return $request->response;
            }

            $categoryId = $request->input('category');
            $subcategoryId = $request->input('subcategory');

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

            if ($request->input('sendEmails')===1)
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

        public function single(Product $product)
        {
            return $product;
        }
    }
