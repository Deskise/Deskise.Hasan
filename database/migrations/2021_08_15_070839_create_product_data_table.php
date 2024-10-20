<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_data', function (Blueprint $table) {
            $table->id('product_id');
            $table->unsignedBigInteger('subcategory_id')->default(null);
            $table->json('data');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on((new \App\Models\Product())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('product_data');
    }
}
