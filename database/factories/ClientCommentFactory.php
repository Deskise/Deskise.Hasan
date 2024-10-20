<?php

namespace Database\Factories;

use App\Models\ClientComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientComment::class;

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
            $data['name_'.$lang] = $this->faker->text(30);
            $data['comment_'.$lang] = $this->faker->text(150);
        }
        $data['img'] = 'default.png';

        return $data;
    }
}
