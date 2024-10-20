<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\ProductBuy;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductBuyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductBuy::class;
    private static $next=0;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'product_id' => ($p=Product::all()[self::$next++])->id,
            'user_id' => User::where('id','!=',$p->user_id)->inRandomOrder()->first()->id,
            'price' => $this->faker->numberBetween(50,999),
            'website_share' => $this->faker->numberBetween(5,50),
        ];
    }
}
