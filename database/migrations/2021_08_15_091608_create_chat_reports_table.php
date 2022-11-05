<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('from');
            $table->string('message');
            $table->enum('status', ['accepted','checking','rejected','waiting'])->default('waiting');
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
        Schema::dropIfExists('chat_reports');
    }
}
