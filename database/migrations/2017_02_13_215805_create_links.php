<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('name')->comment('リンク名');
            $table->string('type')->default(0)->comment('種別');
            $table->string('url')->nullable()->comment('リンクURL');
            $table->string('image')->nullable()->comment('リンク画像');
            $table->string('target')->nullable()->comment('リンクターゲット');
            $table->string('description')->nullable()->comment('リンク説明');
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
        Schema::dropIfExists('links');
    }
}
