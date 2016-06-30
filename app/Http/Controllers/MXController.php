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
		$city1 = DB::table('users_info')->whereusers_id($id_usuario)->get();

		$country = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get()[0]->country;
		$country1 = DB::table('users_info')->whereusers_id($id_usuario)->get();

		if(empty($country) && empty($country1[0]->country)){

			//falta pais
			echo $_GET['callback']."(".json_encode('0').")";

		}else if (  empty($city) && empty($city1[0]->state) ) {

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

	if($pais == ""){
		echo $_GET['callback']."(".json_encode('Error').")";
		return 0;
	}

	$existe = DB::table('users_info')->whereusers_id($id_usuario)->get();

	if(empty($existe)){

		$exito = DB::table('users_info')->insert(
		['users_id' => $id_usuario, 'country' => $pais]
	);

	print_r("Entre a insert");

	if($exito == 1){
		print_r("Exito insert");
		echo $_GET['callback']."(".json_encode('Exito insert').")";
		return 1;
	}else {
		print_r("Error insert");
		echo $_GET['callback']."(".json_encode('Error insert').")";
		return 0;
	}

}else {

	$exito = DB::table('users_info')->where('users_id', $id_usuario)->update(['country' => $pais]);

	if($exito == 1){
		print_r("Exito Update");
		echo $_GET['callback']."(".json_encode('Exito Update').")";
		return 1;
	}else {
		print_r("Error Update");
		echo $_GET['callback']."(".json_encode('Error Update').")";
		return 0;
	}
}
}

public function addstate(){

	$id_usuario = filter_input (INPUT_GET, 'id');
	$estado = filter_input (INPUT_GET, 'state');

	if($estado == ""){
		echo $_GET['callback']."(".json_encode('Error').")";
		return 0;
	}

	$existe = DB::table('users_info')->whereusers_id($id_usuario)->get()[0]->id;

	if(empty($existe)){

		$exito = DB::table('users_info')->insert(
		['users_id' => $id_usuario, 'state' => $estado]
	);

	if($exito == 1){
		echo $_GET['callback']."(".json_encode('Exito insert').")";
		return 1;
	}else {
		echo $_GET['callback']."(".json_encode('Error insert').")";
		return 0;
	}
}else {
	$exito = DB::table('users_info')->where('users_id', $id_usuario)->update(['state' => $estado]);

	if($exito == 1){
		echo $_GET['callback']."(".json_encode('Exito Update').")";
		return 1;
	}else {
		echo $_GET['callback']."(".json_encode('Error Update').")";
		return 0;
	}
}
}
}
