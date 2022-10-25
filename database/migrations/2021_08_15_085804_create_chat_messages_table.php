<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('from');
            $table->enum('type', ['message','attachment','agreement','call']);

            //type: message
            $table->string('message',3500)->nullable();

            //type:attachment
            $table->json('attachments')->default('[]');

            //type: agreement
            $table->float('agreement_price')->nullable();
            $table->string('agreement_notes',400)->nullable();
            $table->string('agreement_details',400)->nullable();
            $table->json('agreement_file_types')->default('[]');

            //type: call, agreement
            $table->enum('status', ['agreement_waiting','agreement_accepted','agreement_canceled','call_accepted','call_missed'])->nullable();

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
        Schema::dropIfExists('chat_messages');
    }
}
