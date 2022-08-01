<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\ChatAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatAgreementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChatAgreement::class;
    protected static $chat = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $chat = Chat::all()[self::$chat++];
        return [
            'chat_id' => $chat->id,
            'from' => $this->faker->randomElement([$chat->member1, $chat->member2]),
            'price'=>$this->faker->randomFloat(2),
            'details'=>$this->faker->text(400),
            'notes' => $this->faker->randomElement([$this->faker->text(400), null, null]),
            'file_types' => [$this->faker->fileExtension(),$this->faker->fileExtension(),$this->faker->fileExtension()],
            'status' => $this->faker->randomElement(['waiting','accepted','canceled']),
            'read' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-4 months')
        ];
    }
}
