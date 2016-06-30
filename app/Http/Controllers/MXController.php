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

		if(empty($country)){
			//falta pais
			echo $_GET['callback']."(".json_encode('0').")";

		}else if ((isset($country)) && ( empty($city))) {

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

	$existe = DB::table('users_info')->whereusers_id($id_usuario)->get();
	print_r($existe);

	if(empty($existe)){
		print_r("Entre a existe =");

		$exito = DB::table('users_info')->insert(
		['users_id' => $id_usuario, 'country' => $pais]
	);

	print_r("Entre a insert");

	if($exito == 1){
		print_r("Exito insert");
		echo $_GET['callback']."(".json_encode('Exito insert').")";
	}else {
		print_r("Error insert");
		echo $_GET['callback']."(".json_encode('Error insert').")";
	}

}else {
	print_r("Entre a update1");
	$exito = DB::table('users_info')->whereusers_id($id_usuario)->update(['country' => $pais]);
print_r("Entre a update2");


	if($exito == 1){
		print_r("Exito Update");
		echo $_GET['callback']."(".json_encode('Exito Update').")";
	}else {
		print_r("Error Update");
		echo $_GET['callback']."(".json_encode('Error Update').")";
	}
}
}

public function addstate(){

	$id_usuario = filter_input (INPUT_GET, 'id');
	$estado = filter_input (INPUT_GET, 'state');

	$existe = DB::table('users_info')->whereuser_id($id_usuario)->get()[0]->id;

	if(empty($existe)){

		$exito = DB::table('users_info')->insert(
		['users_id' => $id_usuario, 'state' => $estado]
	);

	if($exito == 1){
		echo $_GET['callback']."(".json_encode('Exito insert').")";
	}else {
		echo $_GET['callback']."(".json_encode('Error insert').")";
	}
}else {
	$exito = DB::table('users_info')->whereuser_id($id_usuario)
	->update(['state' => $estado]);

	if($exito == 1){
		echo $_GET['callback']."(".json_encode('Exito Update').")";
	}else {
		echo $_GET['callback']."(".json_encode('Error Update').")";
	}
}
}
}
