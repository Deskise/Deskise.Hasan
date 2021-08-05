<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SocialMediaAccount;
use App\Models\SocialMediaLink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialMediaLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocialMediaLink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'userId'    =>  User::all()->random()->first()->id,
            'socialId'  =>  SocialMediaAccount::all()->random()->first()->id,
            'link'      =>  $this->faker->url
        ];
    }
}
