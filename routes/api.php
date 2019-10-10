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
Route::get('/showCategory/{id}', 'CategoryController@showCategory');
Route::get('/relatedCategory/{id}', 'CategoryController@getRelatedCategory');

//Article
Route::get('/listArticle/{id}', 'ArticleController@getArticle');
Route::get('/detailArticle/{id}', 'ArticleController@getDetailArticle');
Route::get('/blogNew/{id}', 'ArticleController@getThreeBlogNew'); // lấy 3 blog mới nhất
Route::get('/threeRelatedArticle/{id}', 'ArticleController@getThreeArticleNew'); // lấy 3 blog mới nhất
Route::get('/threeArticleHome', 'ArticleController@threeArticleHome'); // lấy 3 blog mới nhất home

//event
Route::get('/listEvent', 'Backend\EventController@getAllEvent');
Route::get('/detailEvent/{id}', 'Backend\EventController@detailEvent');
Route::get('/topEvent', 'Backend\EventController@listTopEvent');