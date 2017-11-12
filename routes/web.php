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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', 'PostController@index')->name('posts');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts/create', 'PostController@create');
    Route::post('/posts/create', 'PostController@store');
    
    Route::post('/posts/update', 'PostController@update');
    
    Route::get('/posts/{id}', 'PostController@show');
    Route::get('/posts/{id}/delete', 'PostController@delete');
    Route::post('/posts/delete-by-title', 'PostController@deleteByTitle');
    Route::post('/posts/find-by-title', 'PostController@findByTitle');
});
