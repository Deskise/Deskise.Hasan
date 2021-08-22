<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaProductLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media_product_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('social_id');
            $table->string('link', 250);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on((new \App\Models\Product())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('social_id')->references('id')->on((new \App\Models\socialMediaAccount())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media_product_links');
    }
}
