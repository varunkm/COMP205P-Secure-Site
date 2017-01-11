<?php

use App\Task;
use Illuminate\Http\Request;

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/snippet', 'SnippetController@index');
Route::post('/snippet', 'SnippetController@store');
Route::delete('/snippet/{snippet}', 'SnippetController@destroy');
