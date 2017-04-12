<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use View;
use Auth;
use DB;

class PostController extends Controller
{
    /**
     * 記事 一覧
     *
     * @return View
     */
    public function index()
    {
        return View::make('posts.index');
    }

    /**
     * 記事 新規
     *
     * @param Integer $id
     * @return View
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->can('create', Post::class)) {
            $post = new Post;
            $users = User::all()->pluck('name', 'id');

            return View::make('posts.new')->with(compact('post', 'users'));
        }

        return redirect("/");
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
            $this->success('messages.created', ['name' => '記事']);

            return redirect("/posts/$post->id");
        }

        return redirect("/");
    }

    /**
     * 記事 詳細
     *
     * @param Integer $id
     * @return View
     */
    public function show($id)
    {
        return View::make('posts.show')->with(compact('id'));
        // if ($post = Post::find($id)) {
        // }

        // $this->warning('messages.not_found', ['name' => '記事']);
        // return redirect('/posts');
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
            return View::make('posts.edit')->with(compact('post'));
        }

        $this->warning('messages.not_found', ['name' => '記事']);
        return redirect('/posts');
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
        $post = $post->update($request->all());
        $this->success('messages.updated', ['name' => '記事']);

        return redirect("/posts/$id");
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

        $this->success('messages.deleted', ['name' => '記事']);

        return redirect('/posts');
    }
}
