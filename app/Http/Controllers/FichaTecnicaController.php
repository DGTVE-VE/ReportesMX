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
use Session;
use App\Model\contactos_instit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


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
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        $fichas = Ficha_curso::all ();
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
        $institucion = \App\Model\institucion::find (Auth::user()->institucion_id);
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
        Log::info ('metodo store...');
        Log::info ('Input::get("seccion")'. Input::get('seccion'));
        if (Input::get('seccion') === 'info_basica' ){
            Log::info ('Guardando info_basica');
            return $this->storeInfoBasica ($request);            
        }
        if (Input::get('seccion') === 'contactos' ){
            Log::info ('Guardando Contactos');
            return $this->storeContactos ($request);            
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
        //contacto
        
        $contactos = \App\Model\Contactos_Institucion::where ('institucion_id', Auth::user()->institucion_id)->get();
               
        //$instituciones = \App\Model\institucion::all()->pluck ('nombre_institucion', 'id')->all();
        $tipo_curso = \App\Model\TipoCurso::all()->pluck ('tipo_curso', 'id')->all();
        $institucion = \App\Model\institucion::find (Auth::user()->institucion_id);
        return view('instituciones/registroCurso')
                ->with('name_user', $username)
                ->with('contactos', $contactos)
                ->with('ficha_curso', $ficha)
                ->with('institucion', $institucion)
                ->with('tipo_curso', $tipo_curso)
                ->with('seccion', $seccion)
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
        Log::info('Ficha guardada:'.$ficha);
        return $this->show ($ficha->id, 'info_basica');  
    }
    
    public function storeContactos (Request $request){
        $ids_contactos = Input::get('contactos');        
        $idFicha = Input::get('id');
        $ficha = Ficha_curso::find ($idFicha);
        $ficha->contactos()->detach ();
        //Log::info('ids:'.$ids_contactos);
        if (!empty ($idFicha)){
            //$ficha = Ficha_curso::find (Input::get('id'));
            if ($ids_contactos != null){
                foreach ($ids_contactos as $contacto_id){
                    $contactosFicha = new \App\Model\Contactos_Ficha;
                    $contactosFicha->id_contacto = $contacto_id;
                    $contactosFicha->id_ficha = Input::get('id');
                    $contactosFicha->rol = 'contacto';
                    $contactosFicha->save();
                }
            }
            return $this->show ($idFicha, 'contactos');
        }
        else{
            abort (500, "El formulario no pertenece a ninguna ficha.");
        }        
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
        
        return $this->show ($ficha->id, 'graficos'); 
    }
    public function cursoNuevo($ficha = NULL) {
        Log::info('Ficha: '.$ficha);
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        //contacto
        $contactos = \App\Model\Contactos_Institucion::all ();
        
        if ($ficha === NULL){
            $ficha = new Ficha_curso();
        }
        
        $instituciones = \App\Model\institucion::all()->pluck ('nombre_institucion', 'id')->all();
        $tipo_curso = \App\Model\TipoCurso::all()->pluck ('tipo_curso', 'id')->all();
        return view('instituciones/registroCurso')
                ->with('name_user', $username)
                ->with('contactos', $contactos)                
                ->with('ficha_curso', $ficha)
                ->with('instituciones', $instituciones)
                ->with('tipo_curso', $tipo_curso);
    }

    public function registroNuevo(Request $request) {
        $this->validate($request, [
            'nombreOrganizacion' => 'required',
            'nombreCurso' => 'required',
            'siglasOrg' => 'required',
            'idCurso' => 'required',
            'periodoEmi' => 'required',
            'contactoInst' => 'required',
            'correoInst' => 'required|email',
            'telefonoInst' => 'required|numeric',
            'fechaIni' => 'required|date',
            'fechaFin' => 'required|date',
            'fechaLan' => 'required|date',
            'fechaEmi' => 'required|date',
            // 'lenguajeCont' => 'required',
            // 'lenguajeMult' => 'required',
            'desCorta' => 'required',
            'desLarga' => 'required',
            'requisitos' => 'required',
            'resApren' => 'required',
            // 'nivelCurso' => 'required',
            'tipoConstancia' => 'required',
            'redSociales' => 'required',
            // 'imagenCurso' => 'mimes:jpg,png|image',
            // 'videoCurso' => 'mimes:wmp, mp4, avi, mov',
            'esfuerzoReq' => 'required|min:1|max:10',
            'duracionCurso' => 'required|min:1|max:15',
            // 'cartaCompromiso' => 'mimes:doc, docx',
            // 'cartaAutorizacion' => 'mimes:doc, docx',
            // 'categoria1' => 'required',
            // 'categoria2' => 'required',
            // 'categoria3' => 'required',
            'temario' => 'required',
            'nombreInstructor' => 'required',
            'biografia' => 'required',
            'especializacion' => 'required',
            'obrasImportantes' => 'required',
            // 'firmaElectronica' => 'mimes:jpg,png|image',
            // 'fotoInstructor' => 'mimes:jpg,png|image',}
        ]);


        $destinationPath = 'C:\xampp\htdocs\ReportesMX\public\imagenes\cursos';
        $destinationVideo = 'C:\xampp\htdocs\ReportesMX\public\imagenes\video_curso';
        $destinationFirma = 'C:\xampp\htdocs\ReportesMX\public\imagenes\firmas';
        $destinationFotosInst = 'C:\xampp\htdocs\ReportesMX\public\imagenes\foto_instructor';
        $destinationCartaCom = 'C:\xampp\htdocs\ReportesMX\public\cartas\compromiso';
        $destinationCartaAut = 'C:\xampp\htdocs\ReportesMX\public\cartas\autorizacion';
        $ficha_curso = new Ficha_curso;
        //ficha_curso

        $nameOrg = filter_input(INPUT_POST, 'nombreOrganizacion');
        $ficha_curso->organizacion = $nameOrg;
        $nombreCurso = filter_input(INPUT_POST, 'nombreCurso');
        $ficha_curso->nombre = $nombreCurso;
        $siglasOrga = filter_input(INPUT_POST, 'siglasOrg');
        $ficha_curso->siglas_org = $siglasOrga;
        $idCurso = filter_input(INPUT_POST, 'idCurso');
        $ficha_curso->course_id = $idCurso;
        $periodoEm = filter_input(INPUT_POST, 'periodoEmi');
        $ficha_curso->periodo_emi = $periodoEm;
        $nombreContacto = filter_input(INPUT_POST, 'contactoInst');
        $ficha_curso->contacto_ins = $nombreContacto;
        $correoContacto = filter_input(INPUT_POST, 'correoInst');
        $ficha_curso->correo_ins = $correoContacto;
        $telefonoContacto = filter_input(INPUT_POST, 'telefonoInst');
        $ficha_curso->telefono_ins = $telefonoContacto;


        //Fechas
        $fechaIni = filter_input(INPUT_POST, 'fechaIni');
        $ficha_curso->fecha_ini = $fechaIni;
        $fechaFin = filter_input(INPUT_POST, 'fechaFin');
        $ficha_curso->fecha_fin = $fechaFin;
        $fechaLan = filter_input(INPUT_POST, 'fechaLan');
        $ficha_curso->fecha_lan = $fechaLan;
        $fechaEmi = filter_input(INPUT_POST, 'fechaEmi');
        $ficha_curso->fecha_emi = $fechaEmi;
        $lenguajeCont = filter_input(INPUT_POST, 'lenguajeCont');
        $ficha_curso->lengua_cont = $lenguajeCont;
        $lenguajeMult = filter_input(INPUT_POST, 'lenguajeMult');
//        $ficha_curso->lengua_mult = $lenguajeMult;
//        $lenguajeTrans = filter_input(INPUT_POST, 'lenguajeTrans');
//        $ficha_curso->lengua_trans = $lenguajeTrans;
        //About

        $desCorta = filter_input(INPUT_POST, 'desCorta');
        $ficha_curso->descripcion_cor = $desCorta;
        $desLarga = filter_input(INPUT_POST, 'desLarga');
        $ficha_curso->descripcion_lar = $desLarga;
        $requisitos = filter_input(INPUT_POST, 'requisitos');
        $ficha_curso->requisitos = $requisitos;
        $resApren = filter_input(INPUT_POST, 'resApren');
        $ficha_curso->resultados_esp = $resApren;
        $nivelCurso = filter_input(INPUT_POST, 'nivelCurso');
        $ficha_curso->nivel_curso = 'basico';
        $tipoConstancia = filter_input(INPUT_POST, 'tipoConstancia');
        $ficha_curso->tipo_constancia = $tipoConstancia;
        $redesSoc = filter_input(INPUT_POST, 'redSociales');
        $ficha_curso->redes_sociales = $redesSoc;
        $nombreImagen = Input::file('imagenCurso')->getClientOriginalName();
        $courseImage = Input::file('imagenCurso')->move($destinationPath, $nombreImagen);
        $ficha_curso->imagen = $courseImage;
        $nombreVideo = Input::file('videoCurso')->getClientOriginalName();
        $courseVideo = Input::file('videoCurso')->move($destinationVideo, $nombreVideo);
        $ficha_curso->video = $courseVideo;
        $esfuerzoReq = filter_input(INPUT_POST, 'esfuerzoReq');
        $ficha_curso->esfuerzo_hr_sem = $esfuerzoReq;
        $duracionCurso = filter_input(INPUT_POST, 'duracionCurso');
        $ficha_curso->duracion_sem = $duracionCurso;

        //archivos de llenado
        $cartaCompromiso = Input::file('cartaCompromiso')->getClientOriginalName();
        $compromiso = Input::file('cartaCompromiso')->move($destinationCartaCom, $cartaCompromiso);

        $cartaAutorizacion = Input::file('cartaAutorizacion')->getClientOriginalName();
        $autorizacion = Input::file('cartaAutorizacion')->move($destinationCartaAut, $cartaAutorizacion);

        $categoria1 = filter_input(INPUT_POST, 'categoria1');
        $ficha_curso->categoria1 = $categoria1;
        $categoria2 = filter_input(INPUT_POST, 'categoria2');
        $ficha_curso->categoria2 = $categoria2;
        $categoria3 = filter_input(INPUT_POST, 'categoria3');
        $ficha_curso->categoria3 = $categoria3;
        $temario = filter_input(INPUT_POST, 'temario');
        $ficha_curso->temario = $temario;
        $ficha_curso->save();
        $id_ficha_curso = $ficha_curso->id;

        $name = $request->input('nombreInstructor');
        $biografia = $request->input('biografia');
        $especializacion = $request->input('especializacion');
        $obrasImportantes = $request->input('obrasImportantes');
        $firmaElectronica = $request->file('firmaElectronica');
        $fotoInstructor = $request->file('fotoInstructor');

        $i = 0;

        foreach ($name as $key) {

            $staff = new Instructores();

            $staff->nombre = $key;
            $staff->biografia = $biografia[$i];
            $staff->especialidad = $especializacion[$i];
            $staff->obras_imp = $obrasImportantes[$i];

            $nombreFirma = $firmaElectronica[$i]->getClientOriginalName();
            $InstructorSignature = $firmaElectronica[$i]->move($destinationFirma, $nombreFirma);
            $staff->firma = $InstructorSignature;

            $nombreFoto = $fotoInstructor[$i]->getClientOriginalName();
            $foto_instructor = $fotoInstructor[$i]->move($destinationFotosInst, $nombreFoto);
            $staff->foto = $foto_instructor;

            $staff->save();

            $instructor_ficha = new Instructor_task_ficha();
            $instructor_ficha->instructor_id = $staff->id;
            $instructor_ficha->ficha_curso_id = $id_ficha_curso;
            $instructor_ficha->save();

            $i++;
        }

        // return 0;



        return redirect('registro');
    }

}
