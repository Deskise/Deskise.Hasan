<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\ChatReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChatReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ch = $this->faker->randomElement(Chat::all());
        return [
            //
            'chat_id' => $ch->id,
            'from'  => $this->faker->randomElement($ch->users()),
            'message'=> $this->faker->sentence(15),
            'status' => $this->faker->randomElement(['accepted','checking','rejected','waiting']),
        ];
    }
}
