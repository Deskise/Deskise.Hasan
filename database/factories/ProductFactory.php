<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
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
        $data['name'] = $this->faker->text(30);
        $data['description'] = $this->faker->text(10000);
        $data['summary'] = $this->faker->text(350);

        $data['user_id'] = User::all()->random()->id;
        $data['price'] = $this->faker->randomFloat('2','10','1000');
        $data['img'] = 'default.png';
        $data['category_id'] = Category::all()->random()->id;
        $data['special'] = $this->faker->boolean;
        $data['verified'] = $this->faker->boolean;
        $data['status'] = $this->faker->randomElement(['sold','available','canceled','under_verify']);
        $data['is_lifetime'] = $this->faker->boolean;
        $data['until'] = (!$data['is_lifetime'])?$this->faker->dateTimeThisYear('+12 months'):null;
        $data['old_price'] = $data['price'] + $this->faker->randomFloat('2','10','1000');
        $data['created_at'] = $this->faker->dateTimeBetween('-12 months');
        $data['updated_at'] = $this->faker->dateTimeBetween('-2 month');

        return $data;
    }
}
