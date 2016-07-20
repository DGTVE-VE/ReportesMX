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
//rutas para registro de un nuevo curso
Route::get('registro', 'RegistroController@cursoNuevo');
Route::post('nuevoRegistro','RegistroController@registroNuevo');

Route::get('/', ['middleware' => 'auth', 'uses' => 'UseController@correoacurso']);
Route::any('home', ['middleware' => 'auth', 'uses' => 'UseController@inscritos']);

Route::get('cursos', ['middleware' => 'auth', 'uses' => 'UseController@cursos']);
Route::get('cursoa', ['middleware' => 'auth', 'uses' => 'UseController@cursoa']);
Route::get('curson', ['middleware' => 'auth', 'uses' => 'UseController@curson']);
Route::get('cursoc', ['middleware' => 'auth', 'uses' => 'UseController@cursoc']);

Route::get('totales', ['middleware' => 'auth', 'uses' => 'UseController@totales']);
Route::get('inscritost', ['middleware' => 'auth', 'uses' => 'UseController@inscritost']);
Route::get('infocurso', ['middleware' => 'auth', 'uses' => 'UseController@infocurso']);

Route::get('geo', ['middleware' => 'auth', 'uses' => 'UseController@geo']);
Route::get('videos', ['middleware' => 'auth', 'uses' => 'UseController@videos']);

Route::get('mongo', ['middleware' => 'auth', 'uses' => 'UseController@mongo']);

Route::get('logout', ['middleware' => 'auth', 'uses' => 'UseController@logout']);

//busqueda cursos

Route::get ('/busqueda','BusquedaController@buscarTodos');
Route::get ('/categoria/{categoria}','BusquedaController@muestraCategoria');
Route::post ('busca', 'BusquedaController@buscar');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Route::group(['middleware' => 'auth'], function () {
    Route::post ('mail/show', 'MailController@show');
    Route::get ('mail/send', 'MailController@sendmail');
    Route::get ('mail/compose', 'MailController@index');
    Route::get ('mailTemplate', function (){
        return view ('emails.masivo');
    });
    
//});
    
    
 
 
 
 
