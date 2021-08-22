<?php

    namespace App\Http\Controllers\Api\V1_0_0\traits;

    use App\Helpers\APIHelper;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Facades\Schema;
    use ReflectionClass;

    trait ProductFilter
    {
        /**
         * @param $query
         *
         * @return \Illuminate\Http\JsonResponse|Builder
         */
        protected function filter($query)
        {

            if (request()->input('filters')!==null)
            {
                $validator = \Validator::make(request()->all(), ['filters'=>'json']);
                if ($validator->fails())
                    return APIHelper::error('there were some errors with the request',$validator->errors());

                $filters = json_decode(request()->input('filters'), true, 512, JSON_THROW_ON_ERROR);

                try {
                    $classname = (new ReflectionClass($query->getModel()))->getName();
                    foreach ($filters as $filter=>$value)
                    {
                        $cols = Schema::getColumnListing((new $classname)->getTable());

                        if (in_array($filter, $cols, true))
                        {
                            if (!is_array($value)) {
                                $query->where($filter, $value);
                            } else {
                                $query->whereBetween($filter, array_values($value));
                            }
                        }
                    }
                }catch (\Exception $e)
                {
                    return APIHelper::error('There Was An Exception', $e);
                }
            }

            return $query;
        }
    }
