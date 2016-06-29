<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class UseController extends Controller {

	public function __construct()
	{
	}

	public function verifica(){

		$id_usuario = filter_input (INPUT_POST, 'id');
		$auth_userprofile = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get();
		return $auth_userprofile;
		// if($auth_userprofile[0]->country == ""){
		// 	return 0;
		// }else {
		// 	if($auth_userprofile[0]->city == ""){
		// 		return 1;
		// 	}else {
		// 		return 2;
		// 	}
		// }
	}
	public function addstate(){

		$id_usuario = filter_input (INPUT_POST, 'id');
		$estado = filter_input (INPUT_POST, 'state');

		$existe = DB::table('users_info')->whereuser_id($id_usuario)->get();

		if($existe == ""){

			$exito = DB::table('users_info')->insert(
			['users_id' => $id_usuario, 'state' => $estado]
		);

		if($exito = 1){
			return "Éxito";
		}else {
			return "Ocurrio un error";
		}
	}else {
		$exito = DB::table('users_info')->whereuser_id($id_usuario)
		->update(['state' => $estado]);

		if($exito = 1){
			return "Éxito";
		}else {
			return "Ocurrio un error";
		}
	}
}
public function addcountry(){

	$id_usuario = filter_input (INPUT_POST, 'id');
	$pais = filter_input (INPUT_POST, 'country');

	$existe = DB::table('users_info')->whereuser_id($id_usuario)->get();

	if($existe == ""){

		$exito = DB::table('users_info')->insert(
		['users_id' => $id_usuario, 'country' => $pais]
	);

	if($exito = 1){
		return "Éxito";
	}else {
		return "Ocurrio un error";
	}
	}else {
	$exito = DB::table('users_info')->whereuser_id($id_usuario)
	->update(['country' => $pais]);

	if($exito = 1){
		return "Éxito";
	}else {
		return "Ocurrio un error";
		}
	}
}
}
