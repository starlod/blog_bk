<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostsUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('author_id')->nullable()->after('content')->comment('著者ID');
            $table->integer('creator_id')->nullable()->after('author_id')->comment('作成者ID');
            $table->integer('updater_id')->nullable()->after('creator_id')->comment('更新者ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['author_id', 'creator_id', 'updater_id']);
        });
    }
}
