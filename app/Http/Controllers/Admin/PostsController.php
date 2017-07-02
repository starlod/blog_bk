<?php

namespace App\Http\Controllers\Admin;

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
     * 記事 新規
     *
     * @return View
     */
    public function create()
    {
        $post = new Post;
        return View::make('admin.posts.create')->with(compact('post'));
    }

    /**
     * 記事 追加
     *
     * @param PostRequest $request
     * @return View
     */
    public function store(PostRequest $request)
    {
        $post = new Post($request->all());
        $post->author_id = Auth::user()->id;
        $post->save();
        message('messages.created', 'success', ['name' => '記事']);

        return redirect()->route('admin.posts.index');
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

    /**
     * 記事 編集
     *
     * @param App\Models\Post $post
     * @return View
     */
    public function edit(Post $post)
    {
        return View::make('admin.posts.edit')->with(compact('post'));
    }

    /**
     * 記事 更新
     *
     * @param postRequest $request
     * @param App\Models\Post $post
     * @return Redirect to post index
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        message('messages.updated', 'success', ['name' => '記事']);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * 記事 削除
     *
     * @param App\Models\Post $post
     * @return Redirect to post index
     */
    public function destroy(Post $post)
    {
        $post->delete();

        message('messages.deleted', 'success', ['name' => '記事']);

        return redirect()->route('admin.posts.index');
    }
}
