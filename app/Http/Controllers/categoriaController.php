<?php

namespace App\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Categorias;
use App\Model\CourseName;
use App\Model\CursoCategorias;
use App\Model\Auth_user;
use Session;

class categoriaController extends Controller {

	public function __construct() {

	}
	
	public function categoria(){
        $super_user = session()->get('super_user');
        $correo = session()->get('email');

		if(empty($name = Auth_user::whereemail($correo)->get())){
			return ("Tu correo no esta asociado a algun curso en la plataforma");
		}

		if($super_user == 1)
		{
            $categorias = Categorias::all();
			return view('vinculaCat')->with('categorias', $categorias);
		}
		else{
			return ("Acceso denegado");
		}
	}

	public function consultaCurso(){
        $super_user = session()->get('super_user');
        $correo = session()->get('email');
		if(empty($name = Auth_user::whereemail($correo)->get())){
			return ("Tu correo no esta asociado a algun curso en la plataforma");
		}
		if($super_user == 1)
		{
			$idCurso = $_POST['idCurso'];
			$curso = CourseName::where('course_id', $idCurso)->first();
			return $curso->course_name;
		}
		else{
			return ("Acceso denegado");
		}
	}

	public function guardaCategoria(){
        $super_user = session()->get('super_user');
        $correo = session()->get('email');
		if(empty($name = Auth_user::whereemail($correo)->get())){
			return ("Tu correo no esta asociado a algun curso en la plataforma");
		}
		if($super_user == 1)
		{
			$categorias = $_POST['arregloCat'];
			$idCurso = $_POST['idCurso'];
			$affectedRows = CursoCategorias::where('course_id', '=', $idCurso)->delete();
			foreach($categorias as $categoria){
				$cat = CursoCategorias::firstOrCreate(['course_id' => $idCurso, 'categoria_id' => $categoria]);
			}
		}
		else{
            return ("Acceso denegado");
		}
	}
}
