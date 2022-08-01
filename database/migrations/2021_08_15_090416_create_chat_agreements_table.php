<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('from');
            $table->float('price');
            $table->string('details',400);
            $table->string('notes',400)->nullable();
            $table->json('file_types');
            $table->enum('status', ['waiting','accepted','canceled']);
            $table->boolean('read')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('chat_id')->references('id')->on((new \App\Models\Chat())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('from')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_agreements');
    }
}
