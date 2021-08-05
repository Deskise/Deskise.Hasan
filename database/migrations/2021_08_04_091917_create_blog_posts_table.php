<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
            {
                $table->string('title_'.$lang,30);
                $table->longText('details_'.$lang);
            }
            $table->string('img');
            $table->unsignedBigInteger('categoryId');
            $table->timestamps();

            $table->foreign('categoryId')->references('id')->on((new \App\Models\category())->getTable())->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
