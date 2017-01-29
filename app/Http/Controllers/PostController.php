<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use View;
use DB;

class PostController extends Controller
{
    /**
     * 記事 一覧
     *
     * @return View
     */
    public function index(Request $request)
    {
        $query = Post::query();
        $posts = $query->paginate(20);

        return View::make('posts.index')->with(compact('posts'));
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

        return View::make('posts.new')->with(compact('post'));
    }

    /**
     * 記事 追加
     *
     * @param PostRequest $request
     * @return View
     */
    public function store(PostRequest $request)
    {
        DB::beginTransaction();

        $post = Post::create($request->all());

        DB::commit();

        return redirect("/posts/$post->id");
    }

    /**
     * 記事 詳細
     *
     * @param Integer $id
     * @return View
     */
    public function show($id)
    {
        $post = Post::find($id);

        return View::make('posts.show')->with(compact('post'));
    }

    /**
     * 記事 編集
     *
     * @param Integer $id
     * @return View
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return View::make('posts.edit')->with(compact('post'));
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
        DB::beginTransaction();

        $post = Post::find($id);
        $post = $post->update($request->all());

        DB::commit();

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
        $post = post::find($id);
        $post->delete();

        return redirect('/posts');
    }
}
