<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_drafts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name',30)->nullable();
            $table->longText('description')->nullable();
            $table->string('summary',350)->nullable();
            $table->float('price')->nullable();
            $table->string('img',30)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->boolean('is_lifetime')->default(false);
            $table->date('until')->nullable();
            $table->json('assets')->nullable();
            $table->json('packages')->nullable();
            $table->json('data')->nullable();
            $table->json('socialLinks')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on((new \App\Models\Product())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on((new \App\Models\User())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on((new \App\Models\Category())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('subcategory_id')->references('id')->on((new \App\Models\Subcategory())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_drafts');
    }
}
