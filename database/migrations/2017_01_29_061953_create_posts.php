<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->integer('category_id')->nullable()->comment('カテゴリーID');
            $table->string('status')->default('publish')->comment('記事ステータス');
            $table->string('title')->index()->comment('記事タイトル');
            $table->text('content')->nullable()->comment('記事内容');
            $table->integer('author_id')->nullable()->comment('著者ID');
            $table->integer('creator_id')->nullable()->comment('作成者ID');
            $table->integer('updater_id')->nullable()->comment('更新者ID');
            $table->dateTime('published_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('投稿日時');
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
        Schema::dropIfExists('posts');
    }
}
