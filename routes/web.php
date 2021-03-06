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
Route::get('/', 'SnippetController@index');
Route::get('/home', 'SnippetController@index');
Route::get('/snippets', 'SnippetController@index');
Route::get('/user/{user_id}', 'UserController@profile');
Route::group(
  [ 'middleware' => ['auth']],function(){
  Route::post('/user/edit/{user_id}','UserController@modify');
  Route::post('/file', 'FileController@store');
  Route::get('/file/{file_id}','FileController@retrieve');
  Route::delete('/snippet/{id}', 'SnippetController@destroy');
  Route::post('/snippet/edit/{id}', 'SnippetController@modify');
});
Route::group(
  [ 'middleware' => ['auth','App\Http\Middleware\AdminMiddleware']],function(){
    Route::get('/admin','UserController@admin');
    Route::post('/admin','UserController@changeAdmin');
  });
Route::group(
  [ 'middleware' => ['auth','App\Http\Middleware\SnippetMiddleware']],function(){
    Route::post('/snippet', ['as' => 'createSnippet', 'uses' => 'SnippetController@store']);
  });
