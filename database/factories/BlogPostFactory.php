<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    protected $data;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
        {
            $this->data['title_'.$lang] = $this->faker->text(30);
            $this->data['details_'.$lang] = $this->faker->text(10000);
        }
        $this->data['img'] = 'default.png';
        $this->data['categoryId'] = Category::all()->random()->id;

        return $this->data;
    }
}
