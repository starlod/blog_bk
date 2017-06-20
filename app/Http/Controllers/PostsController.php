<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
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

        return View::make('posts.index', compact('posts'));
    }

    /**
     * 記事 新規
     *
     * @return View
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->can('create', Post::class)) {
            $post = new Post;
            $users = User::all()->pluck('name', 'id');

            return View::make('admin.posts.create')->with(compact('post', 'users'));
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * 記事 追加
     *
     * @param PostRequest $request
     * @return View
     */
    public function store(PostRequest $request)
    {
        if (Auth::check() && Auth::user()->can('create', Post::class)) {
            $post = new Post($request->all());
            $post->author_id = Auth::user()->id;
            $post->save();
            message('messages.created', ['name' => '記事'], 'success');

            return redirect()->route('admin.posts.show', $post->id);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * 記事 詳細
     *
     * @param App\Post $post
     * @return View
     */
    public function show(Post $post)
    {
        return View::make('posts.show')->with(compact('post'));
    }

    /**
     * 記事 編集
     *
     * @param App\Post $post
     * @return View
     */
    public function edit(Post $post)
    {
        return View::make('posts.edit')->with(compact('post'));
    }

    /**
     * 記事 更新
     *
     * @param PostRequest $request
     * @param App\Post $post
     * @return Redirect to post index
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        message('messages.updated', ['name' => '記事'], 'success');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * 記事 削除
     *
     * @param App\Post $post
     * @return Redirect to posts.index
     */
    public function destroy(Post $post)
    {
        $post->delete();

        message('messages.deleted', ['name' => '記事'], 'success');

        return redirect()->route('posts.index');
    }
}
