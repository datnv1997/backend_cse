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

 //category 
Route::get('/listCategory', 'CategoryController@getAllCategory');
Route::get('/listSubCategory', 'CategoryController@getSubCategory');

//Article
Route::get('/listArticle/{id}', 'ArticleController@getArticle');
Route::get('/detailArticle/{id}', 'ArticleController@getDetailArticle');
