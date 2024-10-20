<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mcamara\LaravelLocalization\LaravelLocalization;

class PackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [];
        $dur = ['days','per product','every product'];
        $pack_type = ['email marketing','pin on the top  each category has pin on the top','verified by deskise','take charge of the sales process'];

        foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
        {
            $data['name_'.$lang] = $this->faker->text(20);
            $data['details_'.$lang] = $this->faker->text(350);
        }
        $data['price'] = $this->faker->randomFloat('2',0,100);
        $data['duration'] = $dur[random_int(0, 2)];
        $data['packageType'] = $pack_type[random_int(0,3)];

        return $data;
    }
}
