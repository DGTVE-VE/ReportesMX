<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Model\Course_overviews;
use App\Model\Auth_user;

class ActivaController extends Controller {

	public function __construct()
	{
	}


	public function activa(Request $request){

		$usuario = Auth_user::whereemail($request->email)->first();

		$name_user = session()->get('nombre');

		$this->validate($request, [
			 'email' => 'required'
	 	]);

		if($usuario->is_active == 0){
			$usuario->is_active = 1;
			$usuario->save();
			\Session::flash('message', 'Activación con exito!');
		}
		else {
			\Session::flash('message', 'Usuario ya está activo, nada que hacer.');
		}

		return view('activaUsuario')
		-> with('name_user', $name_user);
	}

	public function buscaUsuario(){

		$name_user = session()->get('nombre');


		return view('activaUsuario')
		-> with('name_user', $name_user);
	}

}
