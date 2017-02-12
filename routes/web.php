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

Route::resource('posts', 'PostController');
Route::resource('posts/{id}/comments', 'CommentController');
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
