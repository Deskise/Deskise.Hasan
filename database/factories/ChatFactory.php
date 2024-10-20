<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;
    protected static $next = 1;
    protected static $n = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = self::$next;
        $otherUsers = User::where('id','>',$user)->get();
        $oUser = $otherUsers[self::$n];

        if (self::$n++===count($otherUsers)-1) {
            self::$n = 0;
            self::$next++;
        }

        return [
            'member1' => $user,
            'member2' => $oUser,
            'product_id' => Product::inRandomOrder()->first()->id
        ];
    }
}
