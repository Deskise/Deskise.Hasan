<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChatMessage::class;
    protected static $chat = 0;
    protected static $n = 5;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (self::$n-- === 0) {
            self::$chat++;
            self::$n = 5;
        }

        $chat = Chat::all()[self::$chat];
        $msg = $this->faker->boolean;
        $attach = (!$msg)?:$this->faker->boolean;

        return [
            'chat_id' => $chat->id,
            'from' => $this->faker->randomElement([$chat->member1, $chat->member2]),
            'message'=> (!$msg)?null:$this->faker->realTextBetween(160,3500),
            'attachments'=> (!$attach)?null:['default.png','default.png','default.png'],
            'read' => self::$n === 0,
            'created_at' => $this->faker->dateTimeBetween('-4 months')

        ];
    }
}
