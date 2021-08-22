<?php

namespace Database\Factories;

use App\Models\SocialMediaAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialMediaAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocialMediaAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [];

        foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
        {
            $data['name_'.$lang] = $this->faker->text(20);
            $data['description_'.$lang] = $this->faker->text(120);
        }

        return $data;
    }
}
