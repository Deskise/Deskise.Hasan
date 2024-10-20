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
            $table->string('firstname',20);
            $table->string('lastname',20);
            $table->string('bio',600)->nullable();
            $table->string('img')->default('default.png');
            $table->string('banner')->default('banner.png');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('backup_email')->unique()->nullable();
            $table->timestamp('backup_email_verified_at')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('backup_phone')->unique()->nullable();
            $table->timestamp('backup_phone_verified_at')->nullable();
            $table->timestamp('id_verified_at')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('password')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_closed')->default(false);
            $table->boolean('banned')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->string('uuid',30)->unique()->nullable();
            $table->softDeletes();
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
