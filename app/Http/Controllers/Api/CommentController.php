<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * 記事 一覧
     *
     * @return View
     */
    public function index(Request $request, $id)
    {
        if ($post = Post::find($id)) {
            return $post->comments()->get();
        }

        return [];
    }

    /**
     * 記事 追加
     *
     * @param PostRequest $request
     * @return View
     */
    public function store(PostRequest $request, $id)
    {
        if ($post = Post::find($id)) {
            $comment = new Comment($request->all());
            $comment->save();

            return $post->comments()->get();
        }

        return [];
    }

    /**
     * 記事 詳細
     *
     * @param Integer $id
     * @return View
     */
    public function show($id, $comment)
    {
        if ($comment = Comment::find($comment)) {
            return $comment->toJson();
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
    public function update(PostRequest $request, $id, $comment)
    {
        $comment = Comment::find($id);
        $comment = $comment->update($request->all());

        return $comment->toJson();
    }

    /**
     * 記事 削除
     *
     * @param Integer $id
     * @return Redirect to post index
     */
    public function destroy($comment)
    {
        if ($comment = Comment::find($id)) {
            $comment->delete();
        }

        return [];
    }
}
