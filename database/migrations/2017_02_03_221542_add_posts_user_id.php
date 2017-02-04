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
            $table->string('author_id')->nullable()->after('body')->comment('著者ID');
            $table->string('created_id')->nullable()->after('author_id')->comment('作成者ID');
            $table->string('updated_id')->nullable()->after('created_id')->comment('更新者ID');
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
            $table->dropColumn(['author_id', 'created_id', 'updated_id']);
        });
    }
}
