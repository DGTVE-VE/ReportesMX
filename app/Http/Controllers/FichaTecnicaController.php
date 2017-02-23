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
use Mail;


class FichaTecnicaController extends Controller {

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
        if (Auth::user()->is_superuser)
            $fichas = Ficha_curso::all();
        else
            $fichas = Ficha_curso::where ('id_institucion', Auth::user()->institucion_id)->get ();
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
        
        $contactos = \App\Model\Contactos_Institucion::all ();
        
        $ficha = new Ficha_curso();
        
        //$instituciones = \App\Model\institucion::all()->pluck ('nombre_institucion', 'id')->all();
        $tipo_curso = \App\Model\TipoCurso::all()->pluck ('tipo_curso', 'id')->all();
        $institucion = \App\Model\Institucion::find (Auth::user()->institucion_id);
        return view('instituciones/registroCurso')
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
            Log::info ('Guardando cartas');            
            return $this->aprobar ($request); 
        }
    }
    
    public function aprobar (Request $request){
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        if (!empty ($idFicha)){
            $ficha->estado = 'aprobada';        
            $ficha->aprobo()->save(Auth::user());
            $ficha->save();
            Session::flash ('success_message', 'Ficha aprobada');
            return $this->show ($idFicha, Input::get ('seccion'));
        }
        else{
            abort (500, "El formulario no pertenece a ninguna ficha.");
        }   
    }
    
    public function enviarRevision (Request $request){
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        if (!empty ($idFicha)){
            $ficha->estado = 'revision';        
            $user = Auth::user();
            Log::info ("Usuario enviando a revision".$user);
            $ficha->edito()->associate($user);
            $ficha->save();
            Session::flash ('success_message', 'Ficha enviada a revisión');
            Mail::send('emails.ficha', ['ficha' => $ficha], function ($m) use ($ficha) {
                $m->from('reportes@mexicox.gob.mx', 'México X');
                $m->to('j.israel.toledo@gmail.com', 'Israel Toledo')
                        ->subject('Una ficha técnica espera ser revisada!');
            });
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
        $contactos = \App\Model\Contactos_Institucion::where ('institucion_id', Auth::user()->institucion_id)->get();
        $tipo_curso = \App\Model\TipoCurso::all()->pluck ('tipo_curso', 'id')->all();
        $categorias = \App\Model\Categorias::all();
        $lineasEstrategicas = \App\Model\LineasEstrategicas::all();
        $institucion = \App\Model\institucion::find (Auth::user()->institucion_id);
        return view('instituciones/registroCurso')
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
        if ($request->hasFile ('carta_compromiso')){            
            Log::info ('carta_compromiso recibida');
            $path = $request->carta_compromiso->move('cartas/', $idFicha.'_compromiso.pdf');
        }
        Session::flash ('success_message', 'Contactos guardados');
        return $this->show ($ficha->id, 'graficos'); 
    }
    
    
    
//    public function cursoNuevo($ficha = NULL) {
//        Log::info('Ficha: '.$ficha);
//        $super_user = session()->get('super_user');
//        $username = session()->get('nombre');
//        //contacto
//        $contactos = \App\Model\Contactos_Institucion::all ();
//        
//        if ($ficha === NULL){
//            $ficha = new Ficha_curso();
//        }
//        
//        $instituciones = \App\Model\institucion::all()->pluck ('nombre_institucion', 'id')->all();
//        $tipo_curso = \App\Model\TipoCurso::all()->pluck ('tipo_curso', 'id')->all();
//        return view('instituciones/registroCurso')
//                ->with('name_user', $username)
//                ->with('contactos', $contactos)                
//                ->with('ficha_curso', $ficha)
//                ->with('instituciones', $instituciones)
//                ->with('tipo_curso', $tipo_curso);
//    }
//
//    public function registroNuevo(Request $request) {
//        $this->validate($request, [
//            'nombreOrganizacion' => 'required',
//            'nombreCurso' => 'required',
//            'siglasOrg' => 'required',
//            'idCurso' => 'required',
//            'periodoEmi' => 'required',
//            'contactoInst' => 'required',
//            'correoInst' => 'required|email',
//            'telefonoInst' => 'required|numeric',
//            'fechaIni' => 'required|date',
//            'fechaFin' => 'required|date',
//            'fechaLan' => 'required|date',
//            'fechaEmi' => 'required|date',
//            // 'lenguajeCont' => 'required',
//            // 'lenguajeMult' => 'required',
//            'desCorta' => 'required',
//            'desLarga' => 'required',
//            'requisitos' => 'required',
//            'resApren' => 'required',
//            // 'nivelCurso' => 'required',
//            'tipoConstancia' => 'required',
//            'redSociales' => 'required',
//            // 'imagenCurso' => 'mimes:jpg,png|image',
//            // 'videoCurso' => 'mimes:wmp, mp4, avi, mov',
//            'esfuerzoReq' => 'required|min:1|max:10',
//            'duracionCurso' => 'required|min:1|max:15',
//            // 'cartaCompromiso' => 'mimes:doc, docx',
//            // 'cartaAutorizacion' => 'mimes:doc, docx',
//            // 'categoria1' => 'required',
//            // 'categoria2' => 'required',
//            // 'categoria3' => 'required',
//            'temario' => 'required',
//            'nombreInstructor' => 'required',
//            'biografia' => 'required',
//            'especializacion' => 'required',
//            'obrasImportantes' => 'required',
//            // 'firmaElectronica' => 'mimes:jpg,png|image',
//            // 'fotoInstructor' => 'mimes:jpg,png|image',}
//        ]);
//
//
//        $destinationPath = 'C:\xampp\htdocs\ReportesMX\public\imagenes\cursos';
//        $destinationVideo = 'C:\xampp\htdocs\ReportesMX\public\imagenes\video_curso';
//        $destinationFirma = 'C:\xampp\htdocs\ReportesMX\public\imagenes\firmas';
//        $destinationFotosInst = 'C:\xampp\htdocs\ReportesMX\public\imagenes\foto_instructor';
//        $destinationCartaCom = 'C:\xampp\htdocs\ReportesMX\public\cartas\compromiso';
//        $destinationCartaAut = 'C:\xampp\htdocs\ReportesMX\public\cartas\autorizacion';
//        $ficha_curso = new Ficha_curso;
//        //ficha_curso
//
//        $nameOrg = filter_input(INPUT_POST, 'nombreOrganizacion');
//        $ficha_curso->organizacion = $nameOrg;
//        $nombreCurso = filter_input(INPUT_POST, 'nombreCurso');
//        $ficha_curso->nombre = $nombreCurso;
//        $siglasOrga = filter_input(INPUT_POST, 'siglasOrg');
//        $ficha_curso->siglas_org = $siglasOrga;
//        $idCurso = filter_input(INPUT_POST, 'idCurso');
//        $ficha_curso->course_id = $idCurso;
//        $periodoEm = filter_input(INPUT_POST, 'periodoEmi');
//        $ficha_curso->periodo_emi = $periodoEm;
//        $nombreContacto = filter_input(INPUT_POST, 'contactoInst');
//        $ficha_curso->contacto_ins = $nombreContacto;
//        $correoContacto = filter_input(INPUT_POST, 'correoInst');
//        $ficha_curso->correo_ins = $correoContacto;
//        $telefonoContacto = filter_input(INPUT_POST, 'telefonoInst');
//        $ficha_curso->telefono_ins = $telefonoContacto;
//
//
//        //Fechas
//        $fechaIni = filter_input(INPUT_POST, 'fechaIni');
//        $ficha_curso->fecha_ini = $fechaIni;
//        $fechaFin = filter_input(INPUT_POST, 'fechaFin');
//        $ficha_curso->fecha_fin = $fechaFin;
//        $fechaLan = filter_input(INPUT_POST, 'fechaLan');
//        $ficha_curso->fecha_lan = $fechaLan;
//        $fechaEmi = filter_input(INPUT_POST, 'fechaEmi');
//        $ficha_curso->fecha_emi = $fechaEmi;
//        $lenguajeCont = filter_input(INPUT_POST, 'lenguajeCont');
//        $ficha_curso->lengua_cont = $lenguajeCont;
//        $lenguajeMult = filter_input(INPUT_POST, 'lenguajeMult');
////        $ficha_curso->lengua_mult = $lenguajeMult;
////        $lenguajeTrans = filter_input(INPUT_POST, 'lenguajeTrans');
////        $ficha_curso->lengua_trans = $lenguajeTrans;
//        //About
//
//        $desCorta = filter_input(INPUT_POST, 'desCorta');
//        $ficha_curso->descripcion_cor = $desCorta;
//        $desLarga = filter_input(INPUT_POST, 'desLarga');
//        $ficha_curso->descripcion_lar = $desLarga;
//        $requisitos = filter_input(INPUT_POST, 'requisitos');
//        $ficha_curso->requisitos = $requisitos;
//        $resApren = filter_input(INPUT_POST, 'resApren');
//        $ficha_curso->resultados_esp = $resApren;
//        $nivelCurso = filter_input(INPUT_POST, 'nivelCurso');
//        $ficha_curso->nivel_curso = 'basico';
//        $tipoConstancia = filter_input(INPUT_POST, 'tipoConstancia');
//        $ficha_curso->tipo_constancia = $tipoConstancia;
//        $redesSoc = filter_input(INPUT_POST, 'redSociales');
//        $ficha_curso->redes_sociales = $redesSoc;
//        $nombreImagen = Input::file('imagenCurso')->getClientOriginalName();
//        $courseImage = Input::file('imagenCurso')->move($destinationPath, $nombreImagen);
//        $ficha_curso->imagen = $courseImage;
//        $nombreVideo = Input::file('videoCurso')->getClientOriginalName();
//        $courseVideo = Input::file('videoCurso')->move($destinationVideo, $nombreVideo);
//        $ficha_curso->video = $courseVideo;
//        $esfuerzoReq = filter_input(INPUT_POST, 'esfuerzoReq');
//        $ficha_curso->esfuerzo_hr_sem = $esfuerzoReq;
//        $duracionCurso = filter_input(INPUT_POST, 'duracionCurso');
//        $ficha_curso->duracion_sem = $duracionCurso;
//
//        //archivos de llenado
//        $cartaCompromiso = Input::file('cartaCompromiso')->getClientOriginalName();
//        $compromiso = Input::file('cartaCompromiso')->move($destinationCartaCom, $cartaCompromiso);
//
//        $cartaAutorizacion = Input::file('cartaAutorizacion')->getClientOriginalName();
//        $autorizacion = Input::file('cartaAutorizacion')->move($destinationCartaAut, $cartaAutorizacion);
//
//        $categoria1 = filter_input(INPUT_POST, 'categoria1');
//        $ficha_curso->categoria1 = $categoria1;
//        $categoria2 = filter_input(INPUT_POST, 'categoria2');
//        $ficha_curso->categoria2 = $categoria2;
//        $categoria3 = filter_input(INPUT_POST, 'categoria3');
//        $ficha_curso->categoria3 = $categoria3;
//        $temario = filter_input(INPUT_POST, 'temario');
//        $ficha_curso->temario = $temario;
//        $ficha_curso->save();
//        $id_ficha_curso = $ficha_curso->id;
//
//        $name = $request->input('nombreInstructor');
//        $biografia = $request->input('biografia');
//        $especializacion = $request->input('especializacion');
//        $obrasImportantes = $request->input('obrasImportantes');
//        $firmaElectronica = $request->file('firmaElectronica');
//        $fotoInstructor = $request->file('fotoInstructor');
//
//        $i = 0;
//
//        foreach ($name as $key) {
//
//            $staff = new Instructores();
//
//            $staff->nombre = $key;
//            $staff->biografia = $biografia[$i];
//            $staff->especialidad = $especializacion[$i];
//            $staff->obras_imp = $obrasImportantes[$i];
//
//            $nombreFirma = $firmaElectronica[$i]->getClientOriginalName();
//            $InstructorSignature = $firmaElectronica[$i]->move($destinationFirma, $nombreFirma);
//            $staff->firma = $InstructorSignature;
//
//            $nombreFoto = $fotoInstructor[$i]->getClientOriginalName();
//            $foto_instructor = $fotoInstructor[$i]->move($destinationFotosInst, $nombreFoto);
//            $staff->foto = $foto_instructor;
//
//            $staff->save();
//
//            $instructor_ficha = new Instructor_task_ficha();
//            $instructor_ficha->instructor_id = $staff->id;
//            $instructor_ficha->ficha_curso_id = $id_ficha_curso;
//            $instructor_ficha->save();
//
//            $i++;
//        }
//
//        // return 0;
//
//
//
//        return redirect('registro');
//    }

}
