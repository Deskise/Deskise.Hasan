<?php

namespace Database\Seeders;

use App\Models\ChatReport;
use Illuminate\Database\Seeder;

class ChatReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ChatReport::factory(50)->create();

    }
}
