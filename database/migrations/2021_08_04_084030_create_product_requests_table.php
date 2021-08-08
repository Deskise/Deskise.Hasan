<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->string('details',350);
            $table->float('ePrice');
            $table->string('email');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on((new \App\Models\category())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('subcategory_id')->references('id')->on((new \App\Models\subcategory())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_requests');
    }
}
