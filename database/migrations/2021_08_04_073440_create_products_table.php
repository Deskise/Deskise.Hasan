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
            $table->unsignedBigInteger('categoryId');
            $table->unsignedBigInteger('subcategoryId');
            $table->enum('special',['y','n'])->default('n');
            $table->enum('verified',['y','n'])->default('n');
            $table->timestamps();

            $table->foreign('categoryId')->references('id')->on((new \App\Models\Category())->getTable())->cascadeOnUpdate();
            $table->foreign('subcategoryId')->references('id')->on((new \App\Models\Subcategory())->getTable())->cascadeOnUpdate();
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
