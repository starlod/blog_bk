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
            $table->string('url')->comment('リンクURL');
            $table->string('image')->comment('リンク画像');
            $table->string('target')->comment('リンクターゲット');
            $table->string('description')->comment('リンク説明');
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
