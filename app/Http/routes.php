<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['middleware' => 'auth', 'uses' => 'UseController@correoacurso']);

Route::any('home', ['middleware' => 'auth', 'uses' => 'UseController@inscritos']);

Route::get('cursos', ['middleware' => 'auth', 'uses' => 'UseController@cursos']);

Route::get('cursoa', ['middleware' => 'auth', 'uses' => 'UseController@cursoa']);
Route::get('curson', ['middleware' => 'auth', 'uses' => 'UseController@curson']);
Route::get('cursoc', ['middleware' => 'auth', 'uses' => 'UseController@cursoc']);

Route::get('totales', ['middleware' => 'auth', 'uses' => 'UseController@totales']);
Route::get('inscritost', ['middleware' => 'auth', 'uses' => 'UseController@inscritost']);

Route::get('genero', ['middleware' => 'auth', 'uses' => 'UseController@genero']);
Route::get('edad', ['middleware' => 'auth', 'uses' => 'UseController@edad']);
Route::get('nivel', ['middleware' => 'auth', 'uses' => 'UseController@nivel']);
Route::get('geo', ['middleware' => 'auth', 'uses' => 'UseController@geo']);

Route::get('desercion', ['middleware' => 'auth', 'uses' => 'UseController@desercion']);

Route::get('videos', ['middleware' => 'auth', 'uses' => 'UseController@videos']);

Route::get('logout', ['middleware' => 'auth', 'uses' => 'UseController@logout']);


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
