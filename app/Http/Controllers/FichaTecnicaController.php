<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Ficha_curso;
use App\Model\Instructores;
use App\Model\Instructor_task_ficha;
use Illuminate\Support\Facades\Input;
//use Session;
use App\Model\contactos_instit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Session;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Client;
use Illuminate\Support\Facades\Redirect;
use Mail;


class FichaTecnicaController extends Controller {

    public $calendarId = 'mexicox.gob.mx_eus964uf8l2lbbjns0g9m8n4hc@group.calendar.google.com';
    public $fromMail = 'admin@mexicox.gob.mx';
    //Correo para añadir tareas en asana.
    public $toMail = 'x+39992588211520@mail.asana.com';
    public $ccMail = [  'griselda.velazquez@mexicox.gob.mx', 
                        'norman.sanchez@mexicox.gob.mx', 
                        'lily.sacal@mexicox.gob.mx',
                        'roberto.pina@mexicox.gob.mx',
                        'israel.toledo@mexicox.gob.mx',
                        'veronica.sanchez@mexicox.gob.mx',
                        'sonia.martinez@mexicox.gob.mx'
                    ];
//    public $mailRecipients = ['israel.toledo@mexicox.gob.mx'];
            
    public function __construct() {

        $this->middleware('auth');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {         
        $username = Auth::user()->name;
        if (Auth::user()->is_superuser){
            $fichas = Ficha_curso::all();
        }else{
            $fichas = Ficha_curso::where ('id_institucion', Auth::user()->institucion_id)->get ();
        }
        return view('formatos/ficha/list')
            ->with('name_user', $username)
            ->with('fichas', $fichas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        
        $contactos = \App\Model\Contactos_institucion::all ();
        
        $ficha = new Ficha_curso();
        
        //$instituciones = \App\Model\Institucion::all()->pluck ('nombre_institucion', 'id')->all();
        $tipo_curso = \App\Model\TipoCurso::all()->pluck ('tipo_curso', 'id')->all();
        $institucion = \App\Model\Institucion::find (Auth::user()->institucion_id);
        return view('formatos/ficha/create')
                ->with('name_user', $username)
                ->with('contactos', $contactos)
                ->with('ficha_curso', $ficha)
                ->with('institucion', $institucion)
                ->with('tipo_curso', $tipo_curso)
                ->with('seccion', 'info_basica');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {        
        Log::info ("Usuario modificando:".Auth::user()->id);
        Log::info ('metodo store...');
        Log::info ('Input::get("seccion")'. Input::get('seccion'));
        $ficha = Ficha_curso::find (Input::get('id'));
        if ($ficha != null){
            $ficha->edito()->associate (Auth::user());        
        }
        if (Input::get('seccion') === 'info_basica' ){
            Log::info ('Guardando info_basica');
            return $this->storeInfoBasica ($request);            
        }
        if (Input::get('seccion') === 'contactos' ){
            Log::info ('Guardando Contactos');
            return $this->storeContactos ($request, 'contacto');            
        }
        if (Input::get('seccion') === 'fechas' ){
            Log::info ('Guardando fechas');
            return $this->storeDatos ($request);            
        }
        if (Input::get('seccion') === 'resumen' ){
            Log::info ('Guardando resumen');
            return $this->storeDatos ($request);            
        }
        if (Input::get('seccion') === 'graficos' ){
            Log::info ('Guardando graficos');
            return $this->storeGraficos ($request);            
        }
        if (Input::get('seccion') === 'staff' ){
            Log::info ('Guardando staff');            
            return $this->storeContactos ($request, 'staff');            
        }
        if (Input::get('seccion') === 'asesores' ){
            Log::info ('Guardando asesores');            
            return $this->storeContactos ($request, 'asesor');            
        }
        if (Input::get('seccion') === 'temario' ){
            Log::info ('Guardando temario');            
            return $this->storeDatos ($request); 
        }
        if (Input::get('seccion') === 'areas' ){
            Log::info ('Guardando areas');            
            return $this->storeAreas ($request); 
        }
        if (Input::get('seccion') === 'cartas' ){
            Log::info ('Guardando cartas');            
            return $this->storeCartas ($request); 
        }
        if (Input::get('seccion') === 'revision' ){
            Log::info ('Guardando cartas');            
            return $this->enviarRevision ($request); 
        }
        if (Input::get('seccion') === 'aprobar' ){                     
            if (Input::get('que_aprueba') === 'curso') {
                return $this->aprobarCurso($request);
            }
            if (Input::get('que_aprueba') === 'carta') {
                return $this->aprobarCarta($request);
            }
        }
        
    }
    
    public function aprobarCarta (Request $request){
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        if (!empty ($idFicha)){
            $ficha->estado = 'edicion';        
            $ficha->aprobo()->associate (Auth::user());
            $ficha->save();
            
            Session::flash ('success_message', 'Carta compromiso aprobada');
            $mensaje = "Carta compromiso aprobada:";
            
            $this->enviaMail($ficha, $mensaje, 'Carta compromiso aprobada');
            
            return $this->show ($idFicha, Input::get ('seccion'));
        }
        else{
            abort (500, "El formulario no pertenece a ninguna ficha.");
        }   
    }
    
    public function publicaFechas ($id){        
        Session::put('id_ficha', $id);
        $client = new Google_Client();
        $client->setAuthConfig(config_path() . '/client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);
        if (Session::has('access_token')) {
          $client->setAccessToken(Session::get('access_token'));              
        } else {
            return Redirect::to($client->createAuthUrl());              
        }
        $ficha = Ficha_curso::find ($id);
        Log::info ("Publicando fechas");
        $service = new Google_Service_Calendar($client);
        dd($id);
        $inicio = $this->getEvent("Inicia: ", $ficha, $ficha->fecha_inicio);
        $r = $service->events->insert($this->calendarId, $inicio);        
        Log::info ("Evento inicio: ".$r->htmlLink);
        
        $fin = $this->getEvent("Termina: ", $ficha, $ficha->fecha_fin);
        $r = $service->events->insert($this->calendarId, $fin);                                 
        Log::info ("Evento fin: ".$r->htmlLink);
        
        return $this->show ($ficha->id, Input::get ('seccion'));
    }
    
    private function getEvent ($title, $ficha, $fecha){
        $event = new Google_Service_Calendar_Event(array(
            'summary' => $title.$ficha->nombre_curso . "(" . $ficha->institucion->siglas . ")" ,                        
            'start' => array(
                'date' => $fecha,
                'timeZone' => 'America/Mexico_City',
            ),
            'end' => array(
                'date' => $fecha,
                'timeZone' => 'America/Mexico_City',
            ),            
        ));
        return $event;
    }
    
    private function enviaMail ($ficha, $mensaje, $subject){
        Mail::send('emails.ficha.revision', ['ficha' => $ficha, 'mensaje'=> $mensaje], 
            function ($m) use ($ficha, $subject) {
                $m->from($this->fromMail, 'México X');
                $m->to($this->toMail)->cc ($this->ccMail)
                        ->subject($subject.$ficha->nombre_curso);
            });
        Log::debug (Mail::failures());
    }
    
    public function aprobarCurso (Request $request){
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        if (!empty ($idFicha)){
            $ficha->estado = 'aprobada';        
            $ficha->aprobo()->associate (Auth::user());
            $ficha->save();
            Session::flash ('success_message', 'Ficha aprobada');
            $mensaje = "Ficha aprobada:";
            $this->enviaMail($ficha, $mensaje, 'Ficha aprobada ');            
            return $this->publicaFechas($ficha);
            //return $this->show ($idFicha, Input::get ('seccion'));
        }
        else{
            abort (500, "El formulario no pertenece a ninguna ficha.");
        }   
    }
    
    public function enviarRevision (Request $request){
        //Permisos para editar el calendario
        
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        if (!empty ($idFicha)){
            $ficha->estado = 'revision';        
            $user = Auth::user();
            Log::info ("Usuario enviando a revision".$user);
            $ficha->edito()->associate($user);
            $ficha->save();
            Session::flash ('success_message', 'Ficha enviada a revisión');
            $mensaje = "Ha enviado una ficha para revisión: ";
            Mail::send('emails.ficha.revision', ['ficha' => $ficha, 'mensaje'=> $mensaje], 
                    function ($m) use ($ficha) {
                        $m->from($this->fromMail, 'México X');
                        $m->to($this->toMail)->cc($this->ccMail)
                                ->subject('Una ficha técnica espera ser revisada: '
                                        .$ficha->nombre_curso);
                    });
                    
            Log::debug (Mail::failures());
            return $this->show ($idFicha, Input::get ('seccion'));
        }
        else{
            abort (500, "El formulario no pertenece a ninguna ficha.");
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $seccion = 'info_basica') {
        
        $ficha = Ficha_curso::find ($id);
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        $contactos = \App\Model\Contactos_institucion::where ('institucion_id', Auth::user()->institucion_id)->get();
        $tipo_curso = \App\Model\TipoCurso::all()->pluck ('tipo_curso', 'id')->all();
        $categorias = \App\Model\Categorias::all();
        $lineasEstrategicas = \App\Model\LineasEstrategicas::all();
        $institucion = \App\Model\Institucion::find (Auth::user()->institucion_id);
        return view('formatos/ficha/create')
                ->with('name_user', $username)
                ->with('contactos', $contactos)
                ->with('ficha_curso', $ficha)
                ->with('institucion', $institucion)
                ->with('tipo_curso', $tipo_curso)
                ->with('seccion', $seccion)
                ->with('lineasEstrategicas', $lineasEstrategicas)
                ->with('categorias', $categorias)
            ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
    
    public function storeInfoBasica (Request $request){
        if (!empty (Input::get('id'))){
            Log::info('Actualizando ficha: '.Input::get('id'));
            $ficha = Ficha_curso::find (Input::get('id'));            
            $ficha->update(Input::all());
        } else{
            Log::info('Guardando nueva ficha');
            $ficha = Ficha_curso::create (Input::all());                        
            $ficha->save();            
            $ficha->creo()->associate(Auth::user());
            $ficha->edito()->associate(Auth::user());
        }
        if ($request->hasFile ('carta_compromiso')){            
            $ficha->estado = 'compromiso';
            $ficha->save();
            Log::info ('carta_compromiso recibida');
            $path = $request->carta_compromiso->move('cartas/', $ficha->id.'_compromiso.pdf');
            $mensaje = "Una institución ha subido una carta compromiso: ";
            Mail::send('emails.ficha.revision', ['ficha' => $ficha, 'mensaje'=> $mensaje], 
                    function ($m) use ($ficha) {
                        $m->from($this->fromMail, 'México X');
                        $m->to($this->toMail)
                                ->cc ($this->ccMail)
                                ->subject('Carta compromiso recibida: '.$ficha->institucion->nombre_institucion.
                                        ' Curso: '.$ficha->nombre_curso );
                    });
        }
        Session::flash ('success_message', 'Información básica guardada');
        Log::info('Ficha guardada:'.$ficha);
        return $this->show ($ficha->id, 'info_basica');  
    }
    
    public function storeContactos (Request $request, $rol){
        $ids_contactos = Input::get('contactos');        
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        $this->detach ($ficha, $rol);
        if (!empty ($idFicha)){            
            if ($ids_contactos != null){
                foreach ($ids_contactos as $contacto_id){
                    $contactosFicha = new \App\Model\Contactos_Ficha;
                    $contactosFicha->id_contacto = $contacto_id;
                    $contactosFicha->id_ficha = Input::get('id');
                    $contactosFicha->rol = $rol;
                    $contactosFicha->save();
                }
            }
            Session::flash ('success_message', 'Contactos guardados');
            return $this->show ($idFicha, Input::get ('seccion'));
        }
        else{
            abort (500, "El formulario no pertenece a ninguna ficha.");
        }        
    }
    
    public function storeAreas (Request $request){
        $ids_categorias = Input::get('categorias');        
        $ids_lineas = Input::get('lineas');        
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        $ficha->categoria_1 = NULL;
        $ficha->categoria_2 = NULL;
        $ficha->categoria_3 = NULL;
        $ficha->linea_estrategica_1 = NULL;
        $ficha->linea_estrategica_2 = NULL;
        $ficha->linea_estrategica_3 = NULL;
        if (!empty ($idFicha)){            
            if (!empty($ids_categorias[0]))
                $ficha->categoria_1 = $ids_categorias[0];
            if (!empty($ids_categorias[1]))
                $ficha->categoria_2 = $ids_categorias[1];
            if (!empty($ids_categorias[2]))
                $ficha->categoria_3 = $ids_categorias[2];
            
            if (!empty($ids_lineas[0]))
                $ficha->linea_estrategica_1 = $ids_lineas[0];
            if (!empty($ids_lineas[1]))
                $ficha->linea_estrategica_2 = $ids_lineas[1];
            if (!empty($ids_lineas[2]))
                $ficha->linea_estrategica_3 = $ids_lineas[2];
            
            $ficha->save();
            Session::flash ('success_message', 'Áreas y líneas guardadas');
            return $this->show ($idFicha, Input::get ('seccion'));
        }
        else{
            abort (500, "El formulario no pertenece a ninguna ficha.");
        }        
    }
    
    public function detach ($ficha, $rol){
        if ($rol === 'contacto') $ficha->contactos()->detach();
        if ($rol === 'staff') $ficha->staff()->detach();
        if ($rol === 'asesor') $ficha->asesores()->detach();
    }
    
    
    public function storeDatos (Request $request){
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        Log::info ('Input:'.implode ("|",Input::all()));
        if (!empty ($idFicha)){
            $ficha->update (Input::all ());
            Log::info ('Ficha:'.$ficha);
        }
        else{
            abort (500, "El formulario no pertenece a ninguna ficha.");
        }
        Session::flash ('success_message', 'Datos guardados');
        return $this->show ($ficha->id, Input::get('seccion'));  
    }
    
    public function storeGraficos (Request $request){
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        
        if ($request->hasFile ('imagen_cuadrada')){            
            Log::info ('Imagen cuadrada recibida');
            $path = $request->imagen_cuadrada->move('imagenes/cursos', $idFicha.'_c.jpg');
            Log::info ('Path:'.$path);
        }
        if ($request->hasFile ('imagen_rectangular')){            
            Log::info ('Imagen rectangular recibida');
            $path = $request->imagen_rectangular->move('imagenes/cursos', $idFicha.'_r.jpg');
            Log::info ('Path:'.$path);
        }
        if ($request->hasFile ('imagen_promocional')){  
            Log::info ('Imagen promocional recibida');
            $path = $request->imagen_promocional->move('imagenes/cursos', $idFicha.'_p.jpg');
            Log::info ('Path:'.$path);
        }
        Session::flash ('success_message', 'Imágenes guardadas');
        return $this->show ($ficha->id, 'graficos'); 
    }
    
    public function storeCartas (Request $request){
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        
        if ($request->hasFile ('carta_autorizacion')){            
            Log::info ('carta_autorizacion recibida');
            $path = $request->carta_autorizacion->move('cartas/', $idFicha.'_autorizacion.pdf');            
        }
        
        Session::flash ('success_message', 'Contactos guardados');
        return $this->show ($ficha->id, 'graficos'); 
    }
    
    
}
