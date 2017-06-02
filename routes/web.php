<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/', 'BlogController@top');
Route::get('/posts/{id}', 'BlogController@show')->name('blog.show');

Route::group(['prefix' => 'admin'], function () {
    Route::get('posts', 'Admin\PostsController@index')->name('admin.posts.index');
    Route::post('posts', 'Admin\PostsController@store')->name('admin.posts.store');
    Route::get('posts/create', 'Admin\PostsController@create')->name('admin.posts.create');
    Route::get('posts/{id}', 'Admin\PostsController@show')->name('admin.posts.show');
    Route::put('posts/{id}', 'Admin\PostsController@update')->name('admin.posts.update');
    Route::delete('posts', 'Admin\PostsController@destroy')->name('admin.posts.destroy');
    Route::get('posts/{id}/edit', 'Admin\PostsController@edit')->name('admin.posts.edit');
});

Route::get('/profile', 'UserController@profile');
Route::put('/profile', 'UserController@profileUpdate');
Route::get('/change_password', 'UserController@changePassword');
Route::put('/change_password', 'UserController@changePasswordUpdate');

Route::get('categories', 'CategoryController@index');
Route::post('categories', 'CategoryController@store');
Route::get('categories/create', 'CategoryController@create');
Route::get('categories/{slug}', 'CategoryController@show');
Route::put('categories/{id}', 'CategoryController@update');
Route::delete('categories', 'CategoryController@destroy');
Route::get('categories/{id}/edit', 'CategoryController@edit');

Route::get('tags', 'TagController@index');
Route::post('tags', 'TagController@store');
Route::get('tags/create', 'TagController@create');
Route::get('tags/{slug}', 'TagController@show');
Route::put('tags/{id}', 'TagController@update');
Route::delete('tags', 'TagController@destroy');
Route::get('tags/{id}/edit', 'TagController@edit');

Route::get('images', 'ImageController@index');
Route::post('images', 'ImageController@store');
Route::get('gallery', 'ImageController@gallery');
