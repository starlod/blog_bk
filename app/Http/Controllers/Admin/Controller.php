<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Post;
use View;

class Controller extends BaseController
{
    /**
     * 記事 一覧
     *
     * @return View
     */
    public function home()
    {
        $posts = Post::all();

        return View::make('admin.posts.index', compact('posts'));
    }
}
