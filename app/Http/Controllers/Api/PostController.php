<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * 記事 一覧
     *
     * @return View
     */
    public function index(Request $request)
    {
        $posts = Post::orderby('updated_at', 'desc')->get();
        if ($posts->count() === 0) {
            return [];
        }

        return $posts->toJson();
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

        return $post->toJson();
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
            return $post->toJson();
        }

        return [];
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

        return $post->toJson();
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

        return [];
    }
}
