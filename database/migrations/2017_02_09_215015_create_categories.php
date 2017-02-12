<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->integer('parent_id')->nullable()->comment('親カテゴリID');
            $table->string('slug')->unique()->comment('スラッグ');
            $table->string('name')->comment('カテゴリ名');
            $table->string('description')->nullable()->comment('説明');
            $table->integer('count')->default(0)->comment('記事件数カウント');
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
        Schema::dropIfExists('categories');
    }
}
