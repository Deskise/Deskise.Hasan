<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('img');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('backup_email')->unique();
            $table->timestamp('backup_email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('backup_phone')->unique();
            $table->timestamp('backup_phone_verified_at')->nullable();
            $table->string('password');
            $table->string('location');
            $table->enum('verified',['y','n'])->default('n');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
