<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Ficha_curso;
use App\Model\Instructores;
use Illuminate\Support\Facades\Input;

class RegistroController extends Controller {

    public function __construct() {
        
        $this->middleware('auth', 
            ['only' => [ 'registroNuevo', 'cursoNuevo']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
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

    public function cursoNuevo() {
//        print 'hola';
        return view('registroCurso')->with('name_user', 'Luis');
    }

    public function registroNuevo() {
        
        $destinationPath='C:\xampp\htdocs\ReportesMX\public\imagenes\cursos';
        $destinationVideo='C:\xampp\htdocs\ReportesMX\public\imagenes\video_curso';
        $destinationFirma='C:\xampp\htdocs\ReportesMX\public\imagenes\firmas';
        $destinationFotosInst='C:\xampp\htdocs\ReportesMX\public\imagenes\foto_instructor';
        $destinationCartaCom='C:\xampp\htdocs\ReportesMX\public\cartas\compromiso';
        $destinationCartaAut='C:\xampp\htdocs\ReportesMX\public\cartas\autorizacion';
        $ficha_curso = new Ficha_curso;
        //ficha_curso
        
        $nameOrg = filter_input(INPUT_POST, 'nombreOrganizacion');
        $ficha_curso->organizacion=$nameOrg;
        $nombreCurso = filter_input(INPUT_POST, 'nombreCurso');
        $ficha_curso->nombre = $nombreCurso;
        $siglasOrga = filter_input(INPUT_POST, 'siglasOrg');
        $ficha_curso->siglas_org=$siglasOrga;
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
        $ficha_curso->lengua_mult = $lenguajeMult;
        $lenguajeTrans = filter_input(INPUT_POST, 'lenguajeTrans');
        $ficha_curso->lengua_trans = $lenguajeTrans;
        
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
        $redesSoc = filter_input(INPUT_POST, 'redSociales');
        $ficha_curso->redes_sociales = $redesSoc;
        $nombreImagen = Input::file('imagenCurso')->getClientOriginalName();
        $courseImage = Input::file('imagenCurso')->move($destinationPath, $nombreImagen);
        $ficha_curso->imagen=$nombreImagen;
        $nombreVideo = Input::file('videoCurso')->getClientOriginalName();
        $courseVideo = Input::file('videoCurso')->move($destinationVideo, $nombreVideo);
        $ficha_curso->video=$nombreVideo;
        $tipoConstancia = filter_input(INPUT_POST, 'tipoConstancia');
        $ficha_curso->tipo_constancia = $tipoConstancia;
        $esfuerzoReq = filter_input(INPUT_POST, 'esfuerzoReq');
        $ficha_curso->esfuerzo_hr_sem = $esfuerzoReq;
        $duracionCurso = filter_input(INPUT_POST, 'duracionCurso');
        $ficha_curso->duracion_sem = $duracionCurso;
        
        
        $nombreFirma = Input::file('firmaElectronica')->getClientOriginalName();
        $InstructorSignature= Input::file('firmaElectronica')->move($destinationFirma,$nombreFirma);
        
        $nombreFoto = Input::file('fotoInstructor')->getClientOriginalName();
        $foto_instructor = Input::file('fotoInstructor')->move($destinationFotosInst,$nombreFoto);
        
        //archivos de llenado
        $cartaCompromiso = Input::file('cartaCompromiso')->getClientOriginalName();
        $compromiso = Input::file('cartaCompromiso')->move($destinationCartaCom,$cartaCompromiso);
        
        $cartaAutorizacion = Input::file('cartaAutorizacion')->getClientOriginalName();
        $autorizacion = Input::file('cartaAutorizacion')->move($destinationCartaAut,$cartaAutorizacion);
        
       
           
        
        $categoria1 = filter_input(INPUT_POST, 'categoria1');
        $ficha_curso->categoria1 = $categoria1;
        $categoria2 = filter_input(INPUT_POST, 'categoria2');
        $ficha_curso->categoria2 = $categoria2;
        $categoria3 = filter_input(INPUT_POST, 'categoria3');
        $ficha_curso->categoria3 = $categoria3;
        $temario = filter_input(INPUT_POST, 'temario');
        $ficha_curso->temario = $temario;
       
        $ficha_curso->save();

        $nombreInstructor = $_POST['nombreInstructor'];
        $biografia = $_POST ['biografia'];
        $especialidad = $_POST['especializacion'];
        $obrasImportantes = $_POST['obrasImportantes'];


        for ($i = 0; $i < count($nombreInstructor); $i++) {
            $staff = new Instructores();
            $staff->nombre = $nombreInstructor[$i];
            $staff->biografia = $biografia[$i];
            $staff->especialidad = $especialidad[$i];
            $staff->obras_imp = $obrasImportantes[$i];
            $ficha_curso->instructores()->save($staff);
        }       
    }            
}
