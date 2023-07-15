<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affiliator_id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('product_id');
            $table->string('tracking_code');
            $table->string('tracking_url');
            $table->timestamps();

            $table->foreign('affiliator_id')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('owner_id')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('product_id')->references('id')->on((new \App\Models\Product())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliates');
    }
}
