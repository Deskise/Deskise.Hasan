<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('package_id');
            $table->enum('status', ['valid','expired','attached']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on((new \App\Models\Product())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('package_id')->references('id')->on((new \App\Models\Package())->getTable())->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_packages');
    }
}
