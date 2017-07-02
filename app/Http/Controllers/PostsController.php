<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use View;
use Auth;
use DB;

class PostsController extends Controller
{
    /**
     * 記事 一覧
     *
     * @return View
     */
    public function index()
    {
        $posts = Post::all();

        return View::make('admin.posts.index', compact('posts'));
    }

    /**
     * 記事 詳細
     *
     * @param App\Models\Post $post
     * @return View
     */
    public function show(Post $post)
    {
        return View::make('admin.posts.show')->with(compact('post'));
    }
}
