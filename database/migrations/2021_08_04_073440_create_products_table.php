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
            foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
            {
                $table->string('name_'.$lang,30);
                $table->longText('description_'.$lang);
            }
            $table->float('price');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedTinyInteger('special')->default(0);
            $table->unsignedTinyInteger('verified')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on((new \App\Models\Category())->getTable())->cascadeOnUpdate();
            $table->foreign('subcategory_id')->references('id')->on((new \App\Models\Subcategory())->getTable())->cascadeOnUpdate();
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
