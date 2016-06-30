<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class MXController extends Controller {

	public function __construct()
	{
	}

	public function verifica(){

		$id_usuario = filter_input(INPUT_GET, 'id');
		$city = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get()[0]->city;
		$country = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get()[0]->country;

		if($country == ""){
			//falta pais
			echo $_GET['callback']."(".json_encode('0').")";

		}else if (($country != "") && ($city == "")) {

			//falta ciudad
			echo $_GET['callback']."(".json_encode('1').")";

		}else{
			//no falta nada
			echo $_GET['callback']."(".json_encode('2').")";
		}

	}

public function addcountry(){

	$id_usuario = filter_input (INPUT_GET, 'id');
	$pais = filter_input (INPUT_GET, 'country');

	echo $_GET['callback']."(".json_encode($pais).")";

// 	$existe = DB::table('users_info')->whereuser_id($id_usuario)->get();
//
// 	echo $_GET['callback']."(".json_encode($existe).")";
//
// 	if($existe == ""){
//
// 		$exito = DB::table('users_info')->insert(
// 		['users_id' => $id_usuario, 'country' => $pais]
// 	);
//
// 	if($exito = 1){
// 		echo $_GET['callback']."(".json_encode('1').")";
// 	}else {
// 		echo $_GET['callback']."(".json_encode('0').")";
// 	}
// }else {
// 	$exito = DB::table('users_info')->whereuser_id($id_usuario)
// 	->update(['country' => $pais]);
//
// 	if($exito = 1){
// 		echo $_GET['callback']."(".json_encode('1').")";
// 	}else {
// 		echo $_GET['callback']."(".json_encode('0').")";
// 	}
// }
}

public function addstate(){

	$id_usuario = filter_input (INPUT_GET, 'id');
	$estado = filter_input (INPUT_GET, 'state');

	$existe = DB::table('users_info')->whereuser_id($id_usuario)->get();

	if($existe == ""){

		$exito = DB::table('users_info')->insert(
		['users_id' => $id_usuario, 'state' => $estado]
	);

	if($exito = 1){
		echo $_GET['callback']."(".json_encode('1').")";
	}else {
		echo $_GET['callback']."(".json_encode('0').")";
	}
}else {
	$exito = DB::table('users_info')->whereuser_id($id_usuario)
	->update(['state' => $estado]);

	if($exito = 1){
		echo $_GET['callback']."(".json_encode('1').")";
	}else {
		echo $_GET['callback']."(".json_encode('0').")";
	}
}
}
}
