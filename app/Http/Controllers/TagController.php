<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Models\Post;
use View;

class TagController extends Controller
{
    /**
     * タグ 一覧
     *
     * @return View
     */
    public function index(Request $request)
    {
        $tags = Tag::ordered()->get();
        if ($tags->count() === 0) {
            message('messages.no_tags');
        }

        return View::make('tags.index')->with(compact('tags'));
    }

    /**
     * タグ 新規
     *
     * @param Integer $id
     * @return View
     */
    public function create()
    {
        $tag = new Tag;
        $tags = Tag::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');

        return View::make('tags.new')->with(compact('tag', 'tags', 'users'));
    }

    /**
     * タグ 追加
     *
     * @param TagRequest $request
     * @return View
     */
    public function store(TagRequest $request)
    {
        $tag = new Tag($request->all());
        $tag->author_id = Auth::user()->id;
        $tag->save();
        message('messages.created', ['name' => 'タグ'], 'success');

        return redirect("/tags/$tag->id");
    }

    /**
     * タグ 詳細
     *
     * @param String $slug
     * @return View
     */
    public function show($slug)
    {
        if ($tag = Tag::where('slug', $slug)->first()) {
            $posts = Post::where('tag_id', $tag->id)->paginate(20);
            return View::make('blog.top')->with(compact('tag', 'posts'));
        }

        message('messages.not_found', ['name' => 'タグ'], 'warning');
        return redirect('/');
    }

    /**
     * タグ 編集
     *
     * @param Integer $id
     * @return View
     */
    public function edit($id)
    {
        $tags = Tag::all()->pluck('name', 'id');
        if ($tag = Tag::find($id)) {
            return View::make('tags.edit')->with(compact('tag', 'tags'));
        }

        message('messages.not_found', ['name' => 'タグ'], 'warning');
        return redirect('/tags/');
    }

    /**
     * タグ 更新
     *
     * @param tagRequest $request
     * @param Integer $id
     * @return Redirect to tag index
     */
    public function update(TagRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag = $tag->update($request->all());
        message('messages.updated', ['name' => 'タグ'], 'success');

        return redirect("/tags/$id/edit");
    }

    /**
     * タグ 削除
     *
     * @param Integer $id
     * @return Redirect to tag index
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        message('messages.deleted', ['name' => 'タグ'], 'success');

        return redirect('/tags');
    }
}
