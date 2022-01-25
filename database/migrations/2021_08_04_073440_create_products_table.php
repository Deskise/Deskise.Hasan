<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name_en',30);
            $table->longText('description_en');
            $table->string('summary_en',350);
            $table->string('name_ar',30);
            $table->longText('description_ar');
            $table->string('summary_ar',350);
            $table->float('price');
            $table->string('img',30);
            $table->unsignedBigInteger('category_id');
            $table->boolean('special')->default(false);
            $table->boolean('verified')->default(false);
            $table->enum('status',['sold','available','canceled','under_verify'])->default('under_verify');
            $table->boolean('is_lifetime')->default(false);
            $table->date('until')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on((new \App\Models\Category())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
