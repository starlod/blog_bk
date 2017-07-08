<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', 'Controller@home');
Route::resource('posts', 'PostsController', ['as' => 'admin']);
// Route::resource('posts/{post}/comments', 'CommentsController', ['as' => 'admin']);
