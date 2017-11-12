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

// Route::middleware('auth:api')->get('/user', function () {
    
// });

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('get-details', 'API\PassportController@getDetails');
});

// ----------------------API-----------------------------
Route::namespace('API')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::group(['middleware' => 'auth:api', 'prefix' => 'posts'], function () {
        Route::post('/', 'PostController@getAll');
        Route::post('create', 'PostController@create');
        Route::post('update', 'PostController@update');
        Route::get('{id}/delete', 'PostController@delete');
        Route::get('{id}', 'PostController@getById');
    });

    Route::post('login', 'PassportController@login');
    Route::post('register', 'PassportController@register');
});
