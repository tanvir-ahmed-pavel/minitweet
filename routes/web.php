<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "PagesController@home")->name('home');
Route::get('/about', "PagesController@about");
Route::resource("post", "PostsController");
Route::post("/post/{post}/comment", "CommentsController@store")->name('post.comment');
Route::post("/post/comment/{post}", "CommentsController@index")->name('index.comment');
Route::post("/comment/{post}", "CommentsController@show")->name('show.comment');
Route::delete("/post/comment/delete/{comment}", "CommentsController@destroy")->name('delete.comment');
Route::post('/post/like/{user}', 'LikesController@store')->name('store.like');
Route::post('/like/{post}', 'LikesController@index')->name('get.like');

Auth::routes();

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::post('/follow/{user}', 'FollowersController@store')->name('profile.follow');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

