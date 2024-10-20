<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductData;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductData::class;
    private static $next=0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'    =>  Product::all()[self::$next++]->id,
            'subcategory_id'=>  Subcategory::all()->random()->id,
            'data'          =>  []
        ];
    }
}
