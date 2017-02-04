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

Route::get('/', function () {
    return redirect('posts');
});

Route::resource('posts', 'PostController');
Route::get('/profile', 'UserController@profile');
Route::put('/profile', 'UserController@profileUpdate');
Route::get('/change_password', 'UserController@changePassword');
Route::put('/change_password', 'UserController@changePasswordUpdate');
