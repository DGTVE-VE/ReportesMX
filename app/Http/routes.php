<?php

use Illuminate\Http\Request;
use App\Helpers\GoogleApi;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

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

/*
 * Ruta callback a donde regresa después de hacer el login en google para
 * usar las APIS.
 */

Route::get ('recomendacion', function (){
    return view('formatos.ficha.recomendarNavegador')
            ->with ('name_user', Auth::user ()->name);
});

Route::get ('whichBrowser', function (){
//    $browser = \hisorange\BrowserDetect\Facade\Parser::browserFamily();
    $agent = new Jenssegers\Agent\Agent;
    $browser = $agent->browser();
    print $browser;
});

Route::get ('formatos/ficha_tecnica/publica/{id}', 'FichaTecnicaController@publicaFechas');

Route::get ('asociaUsuario', function (){
    return view('asociaUsuarioInstitucion');
})->middleware ('auth');

Route::post ('asociaUsuario', function (){
    $user = App\User::find (Input::get('usuario_id'));
    $user->institucion_id = Input::get('institucion_id');
    $user->save ();
    
    return redirect('/');
})->middleware ('auth');

Route::post ('buscaCorreo', function (){    
    $user = App\User::where ('email', Input::get ('email'))->first();
    return view('asociaUsuarioInstitucion')
            ->with ('usuarioAasociar', $user)
            ->with ('instituciones', \App\Model\Institucion::all()
                    ->pluck ('nombre_institucion', 'id'));            
})->middleware ('auth');

Route::post ('usuario/asocia/institucion', function (){
    if (Input::has ('institucion_id')){
        $user = Auth::user ();
        $user->institucion_id = Input::get ('institucion_id');
        $user->save ();
        return Redirect::to(url('formatos/ficha_tecnica'));
    }else{
        abort (404, 'Página no encontrada');
    }
});
Route::get ('google_api/oauth2callback', function (Request $request){
    $client = new Google_Client();
    $client->setAuthConfigFile(config_path() . '/client_secret.json');
    $client->setRedirectUri(url('google_api/oauth2callback'));
    $client->addScope(Google_Service_Calendar::CALENDAR);

    if (Input::has('code')) {
        $client->authenticate(Input::get('code'));
        Session::put ('access_token', $client->getAccessToken());
        $path = url('formatos/ficha_tecnica/publica/'.Session::get('id_ficha'));
        return Redirect::to($path);
    } else {
        return Redirect::to($client->createAuthUrl());
    }

});
Route::resource ('formatos/ficha_tecnica', 'FichaTecnicaController');
        

Route::get('/', ['middleware' => 'auth', 'uses' => 'MXController@blog']);
Route::any('home', ['middleware' => 'auth', 'uses' => 'MXController@blog']);

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

Route::get('other_course', ['middleware' => 'auth', 'uses' => 'UseController@other_course']);

Route::get('logout', ['middleware' => 'auth', 'uses' => 'UseController@logout']);

//*Ruta para dar de alta Cursos*//
Route::resource('admin/course_name', 'Course_nameController');


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
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');;
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
Route::get('asociaCategoria', 'categoriaController@categoria');
Route::post('asignaCategoria', 'categoriaController@guardaCategoria');
Route::post('consultaCurso', 'categoriaController@consultaCurso');


Route::resource('instituciones/contactos', 'contactos_institucionController@contactos');

Route::resource('instituciones/institucion', 'institucionController');
Route::resource('admin/course_name', 'Course_nameController');
Route::resource('instituciones/contactos_institucion', 'Contactos_institucionController');
Route::resource('admin/banner_principal', 'banner_principalController');
/*Búsqueda de course_id en el catalogo de Course_name*/
Route::match(array('GET','POST'),'curso/busqueda/{curso?}', array('uses'=>'Course_nameController@busquedaCursos'));
