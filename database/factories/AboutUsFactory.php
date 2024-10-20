<?php

namespace Database\Factories;

use App\Models\AboutUs;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutUs::class;

    protected $data = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
        {
            $this->data['home_'.$lang] = $this->faker->text(350);
            $this->data['about_'.$lang] = $this->faker->text(10000);
        }
        return $this->data;
    }
}
