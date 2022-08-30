<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ProductRequest;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'category_id' => Category::all()->random()->id,
            'subcategory_id' => Subcategory::all()->random()->id,
            'details' => $this->faker->text(1000),
            'ePrice' =>  $this->faker->randomFloat('2','10','1000'),
            'email' => $this->faker->email(),
            'status' => $this->faker->randomElement(['approved','rejected','waiting']),
            'created_at'=> $this->faker->dateTimeBetween('-12 months'),
            'updated_at'=> $this->faker->dateTimeBetween('-2 month'),
        ];
    }
}
