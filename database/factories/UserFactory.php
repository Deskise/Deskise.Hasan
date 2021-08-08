<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname'  => $this->faker->lastName(),
            'img'       => 'default.png',
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'backup_email' => $this->faker->unique()->safeEmail(),
            'backup_email_verified_at' => now(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'phone_verified_at' => now(),
            'backup_phone' => $this->faker->unique()->phoneNumber(),
            'backup_phone_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'location' => implode(',',$this->faker->localCoordinates()),
            'verified'  => '1',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
