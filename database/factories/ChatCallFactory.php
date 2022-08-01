<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\ChatCall;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatCallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChatCall::class;
    protected static $chat = 0;
    protected static $n = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (self::$n<0) {
            self::$n = 1;
            self::$chat++;
        }
        $status = ['missed','accepted'];
        $chat = Chat::all()[self::$chat];

        return [
            'chat_id' => $chat->id,
            'from' => $this->faker->randomElement([$chat->member1, $chat->member2]),
            'status' => $status[self::$n--],
            'read' => true,
            'created_at' => $this->faker->dateTimeBetween('-4 months')
        ];
    }
}
