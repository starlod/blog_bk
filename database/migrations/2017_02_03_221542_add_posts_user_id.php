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
            $table->string('author_id')->after('body')->comment('著者ID');
            $table->string('created_by_id')->after('author_id')->comment('作成者ID');
            $table->string('updated_by_id')->after('created_by_id')->comment('更新者ID');
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
            $table->dropColumn(['author_id', 'created_by_id', 'updated_by_id']);
        });
    }
}
