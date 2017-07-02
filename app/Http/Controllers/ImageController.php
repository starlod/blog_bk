<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Models\Link;
use View;
use Storage;

class ImageController extends Controller
{
    /**
     * イメージ 一覧
     *
     * @return View
     */
    public function index(Request $request)
    {
        return View::make('images.index');
    }

    /**
     * イメージ 一覧
     *
     * @return View
     */
    public function gallery(Request $request)
    {
        return View::make('images.gallery');
    }

    /**
     * イメージ 新規
     *
     * @param Integer $id
     * @return View
     */
    public function create()
    {
        $link = new Link;
        $images = Link::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');

        return View::make('images.new')->with(compact('image', 'images', 'users'));
    }

    /**
     * イメージ 追加
     *
     * @param ImageRequest $request
     * @return View
     */
    public function store(Request $request)
    {
        // アップロードの取得
        $path =  Storage::putFile('public/images', $request->file('file'));

        $link = new Link($request->all());
        $link->name = 'テスト画像';
        $link->image = $path;
        $link->save();
        message('messages.created', ['name' => 'イメージ'], 'success');

        return redirect("/images");
    }

    /**
     * イメージ 詳細
     *
     * @param String $slug
     * @return View
     */
    public function show($slug)
    {
        if ($image = Image::where('slug', $slug)->first()) {
            $posts = Post::where('image_id', $image->id)->paginate(20);
            return View::make('blog.top')->with(compact('image', 'posts'));
        }

        message('messages.not_found', ['name' => 'イメージ'], 'warning');
        return redirect('/');
    }

    /**
     * イメージ 編集
     *
     * @param Integer $id
     * @return View
     */
    public function edit($id)
    {
        $images = Image::all()->pluck('name', 'id');
        if ($image = Image::find($id)) {
            return View::make('images.edit')->with(compact('image', 'images'));
        }

        message('messages.not_found', ['name' => 'イメージ'], 'warning');
        return redirect('/images/');
    }

    /**
     * イメージ 更新
     *
     * @param imageRequest $request
     * @param Integer $id
     * @return Redirect to image index
     */
    public function update(ImageRequest $request, $id)
    {
        $image = Image::find($id);
        $image = $image->update($request->all());
        message('messages.updated', ['name' => 'イメージ'], 'success');

        return redirect("/images/$id/edit");
    }

    /**
     * イメージ 削除
     *
     * @param Integer $id
     * @return Redirect to image index
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();

        message('messages.deleted', ['name' => 'イメージ'], 'success');

        return redirect('/images');
    }
}
