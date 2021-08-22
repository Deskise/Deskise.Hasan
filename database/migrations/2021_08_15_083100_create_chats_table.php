<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member1');
            $table->unsignedBigInteger('member2');
            $table->unsignedBigInteger('product_id');
            $table->boolean('blocked');
            $table->unsignedBigInteger('blocker_id');
            $table->timestamps();

            $table->foreign('member1')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('member2')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('product_id')->references('id')->on((new \App\Models\Product())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('blocker_id')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
