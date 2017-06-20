<?php

namespace App\Http\Controllers\Admin;

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

        return View::make('admin.posts.index', compact('posts'));
    }

    /**
     * 記事 新規
     *
     * @param Integer $id
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
     * @param Integer $id
     * @return View
     */
    public function show($id)
    {
        if ($post = Post::find($id)) {
            return View::make('admin.posts.show')->with(compact('post'));
        }

        message('messages.not_found', 'warning', ['name' => '記事']);

        return redirect()->route('admin.posts.index');
    }

    /**
     * 記事 編集
     *
     * @param Integer $id
     * @return View
     */
    public function edit($id)
    {
        if ($post = Post::find($id)) {
            return View::make('admin.posts.edit')->with(compact('post'));
        }

        message('messages.not_found', 'warning', ['name' => '記事']);

        return redirect()->route('admin.posts.index');
    }

    /**
     * 記事 更新
     *
     * @param postRequest $request
     * @param Integer $id
     * @return Redirect to post index
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->all());

        message('messages.updated', 'success', ['name' => '記事']);

        return redirect()->route('admin.posts.show', $id);
    }

    /**
     * 記事 削除
     *
     * @param Integer $id
     * @return Redirect to post index
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        message('messages.deleted', 'success', ['name' => '記事']);

        return redirect()->route('admin.posts.index');
    }
}
