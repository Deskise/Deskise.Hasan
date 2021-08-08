<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [];
        $yn = ['y','n'];
        foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
        {
            $data['name_'.$lang] = $this->faker->text(30);
            $data['description_'.$lang] = $this->faker->text(10000);
        }
        $data['price'] = $this->faker->randomFloat('2','10','1000');
        $data['special'] = random_int(0,1);
        $data['verified'] = random_int(0,1);
        $data['category_id'] = Category::all()->random()->id;
        $data['subcategory_id'] = Subcategory::all()->random()->id;

        return $data;
    }
}
