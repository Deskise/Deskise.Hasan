<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceDataFactory extends Factory
{
    protected $model = Setting::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [
            [
                'key'=>'profit_rate',
                'value' => 0
            ],
            [
                'key'=>'tax_rate',
                'value' => 0
            ],
            [
                'key'=>'bank_commission',
                'value' => 0
            ],
            [
                'key'=>'withdraw_limits',
                'value' => 0
            ],
        ];
        return $data;
    }
}
