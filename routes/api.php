<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// ----------------------API-----------------------------
Route::prefix('posts')->group(function () {
    Route::get('/', 'PostAPIController@getAll');
    Route::post('create', 'PostAPIController@create');
    Route::post('update', 'PostAPIController@update');
    Route::get('{id}/delete', 'PostAPIController@delete');
    Route::get('{id}', 'PostAPIController@getById');
});
