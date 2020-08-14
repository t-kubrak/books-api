<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('books', function () {
    return \App\Book::all();
});

Route::get('authors', function () {
    return \App\Author::all();
});

Route::get('authors/{id}/books', function ($id) {
    $author = \App\Author::find($id);

    if (!$author) {
        return [];
    }

    return $author->books;
});

Route::post('register', 'RegisterController@register');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('books/user', function () {
        $user = auth()->user();
        return \App\Book::where('user_id', $user->id)->get();
    });
});
