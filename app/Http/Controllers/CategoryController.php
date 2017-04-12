<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;
use App\Post;
use View;

class CategoryController extends Controller
{
    /**
     * カテゴリー 一覧
     *
     * @return View
     */
    public function index(Request $request)
    {
        $categories = Category::ordered()->get();
        if ($categories->count() === 0) {
            message('messages.no_categories');
        }

        return View::make('categories.index')->with(compact('categories'));
    }

    /**
     * カテゴリー 新規
     *
     * @param Integer $id
     * @return View
     */
    public function create()
    {
        $category = new Category;
        $categories = Category::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');

        return View::make('categories.new')->with(compact('category', 'categories', 'users'));
    }

    /**
     * カテゴリー 追加
     *
     * @param CategoryRequest $request
     * @return View
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
        $category->author_id = Auth::user()->id;
        $category->save();
        message('messages.created', ['name' => 'カテゴリー'], 'success');

        return redirect("/categories/$category->id");
    }

    /**
     * カテゴリー 詳細
     *
     * @param String $slug
     * @return View
     */
    public function show($slug)
    {
        if ($category = Category::where('slug', $slug)->first()) {
            $posts = Post::where('category_id', $category->id)->paginate(20);
            return View::make('blog.top')->with(compact('category', 'posts'));
        }

        message('messages.not_found', ['name' => 'カテゴリー'], 'warning');
        return redirect('/');
    }

    /**
     * カテゴリー 編集
     *
     * @param Integer $id
     * @return View
     */
    public function edit($id)
    {
        $categories = Category::all()->pluck('name', 'id');
        if ($category = Category::find($id)) {
            return View::make('categories.edit')->with(compact('category', 'categories'));
        }

        message('messages.not_found', ['name' => 'カテゴリー'], 'warning');
        return redirect('/categories/');
    }

    /**
     * カテゴリー 更新
     *
     * @param categoryRequest $request
     * @param Integer $id
     * @return Redirect to category index
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category = $category->update($request->all());
        message('messages.updated', ['name' => 'カテゴリー'], 'success');

        return redirect("/categories/$id/edit");
    }

    /**
     * カテゴリー 削除
     *
     * @param Integer $id
     * @return Redirect to category index
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        message('messages.deleted', ['name' => 'カテゴリー'], 'success');

        return redirect('/categories');
    }
}
