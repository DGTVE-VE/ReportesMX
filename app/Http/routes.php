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
Route::get('descarga','RegistroController@downloadFile');

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


Route::get ('/busqueda','BusquedaController@buscarTodos');
Route::get ('/categoria/{categoria}','BusquedaController@muestraCategoria');
Route::post ('busca', 'BusquedaController@buscar');


Route::any('verifica', 'MXController@verifica');
Route::any('adddata', 'MXController@adddata');
Route::any('validarcp', 'MXController@validarcp');

Route::any('show', 'SincoController@show');
Route::any('store', 'SincoController@store');

Route::any('uploadvideo', 'MXController@uploadvideo');
Route::any('savevideo', 'MXController@savevideo');
Route::any('success', 'MXController@success');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Ruta para la Consulta de Folios en la tabla de constancias
Route::match(array('GET','POST'),'constancias/{folio?}', array('uses'=>'ConstanciasController@constancias'));
//ruta para el servicio Web de la tabla Auth_userprofile
Route::match(array('GET','POST'),'webService', array('uses'=>'ConstanciasController@webService'));

//Route::group(['middleware' => 'auth'], function () {
    Route::get ('mail/eco/{id}', 'MailController@eco');
    Route::get ('mail/count', 'MailController@getTotalRecords');
    Route::post ('mail/show', 'MailController@show');
    Route::post ('mail/send', ['middleware' => 'auth', 'uses' => 'MailController@sendmail']);
    Route::get ('mail/compose', ['middleware' => 'auth', 'uses' => 'MailController@create']);
    Route::get ('mail/test', 'MailController@test');
    Route::get ('mailTemplate', function (){
        return view ('emails.masivo');
    });
    Route::get ('mail/unsuscribe', function (){
        return view ('mail.unsuscribe');
    });
    Route::post ('mail/unsuscribe', 'MailController@unsuscribe');

Route::group(array('middleware' => 'auth'), function(){
    Route::controller('filemanager', 'FilemanagerLaravelController');
});
Route::get ('phpinfo', function (){
    phpinfo ();
});

Route::get('mongo', 'MongoController@mongo');
Route::get('blog', 'MXController@blog');
Route::any('viewblog', 'MXController@viewblog');
Route::any('getblog', 'MXController@getblog');
Route::any('adminblog', ['middleware' => 'auth', 'uses' => 'MXController@adminblog']);
Route::any('saveblog', ['middleware' => 'auth', 'uses' => 'MXController@saveblog']);

Route::get('email/preview', function (){
    return view ('emails.masivo');
});
Route::resource('admin/course_name', 'Course_nameController');