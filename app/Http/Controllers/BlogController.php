<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use View;

class BlogController extends Controller
{
    /**
     * 記事 一覧
     *
     * @return View
     */
    public function top(Request $request)
    {
        $posts = Post::orderby('updated_at', 'desc')->paginate(20);

        if ($posts->count() === 0) {
            message('messages.no_posts');
        }

        return View::make('blog.top')->with(compact('posts'));
    }

    /**
     * 記事 詳細
     *
     * @return View
     */
    public function show($id)
    {
        if ($post = Post::find($id)) {
            return View::make('blog.show')->with(compact('post'));
        }

        // message('messages.no_posts');
        return redirect()->route('home');
    }
}
