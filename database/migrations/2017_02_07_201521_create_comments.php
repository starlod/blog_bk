<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->comment('記事ID');
            $table->integer('parent_id')->nullable()->comment('親コメントID');
            $table->integer('author_id')->nullable()->comment('投稿者ID');
            $table->string('hash_ip', 32)->comment('ハッシュIP(MD5)');
            $table->string('name')->comment('コメント投稿者名');
            $table->text('content')->comment('コメント内容');
            $table->string('email')->nullable()->comment('メールアドレス');
            $table->string('ip')->nullable()->comment('IPアドレス');
            $table->integer('approved')->default(0)->comment('承認');
            $table->string('agent')->nullable()->comment('ユーザエージェント');
            $table->integer('type')->default(0)->comment('コメント種別');
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
        Schema::dropIfExists('comments');
    }
}
