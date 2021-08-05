<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('socialId');
            $table->string('link', 250);
            $table->timestamps();

            $table->foreign('userId')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('socialId')->references('id')->on((new \App\Models\socialMediaAccount())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media_links');
    }
}
