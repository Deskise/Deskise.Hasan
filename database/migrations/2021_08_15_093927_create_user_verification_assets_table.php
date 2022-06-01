<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVerificationAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verification_assets', function (Blueprint $table) {
            $table->id('user_id');
            $table->json('assets');
            // ['user_61c8fd818741c3.69616718_1640562049.png', 'user_61c8fd818741c3.69616718_1640562049.png']
            // route('images', ['for'=>'user_assets', 'image'=>$image]);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on((new \App\Models\User())->getTable());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verification_assets');
    }
}
