<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserVerificationAssets;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserVerificationAssetsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserVerificationAssets::class;
    protected static $next = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::whereNotIn('id',UserVerificationAssets::all()->pluck('user_id'))->get()[self::$next++]->id,
            'assets' => ['default.png','default.png','default.png'],
            'rejectMessage' => null
        ];
    }
}
