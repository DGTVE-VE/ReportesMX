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

		$city = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get();
		$city1 = DB::table('users_info')->whereusers_id($id_usuario)->get();

		$country = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get();
		$country1 = DB::table('users_info')->whereusers_id($id_usuario)->get();


		if(empty($country[0]->country) && empty($country1)){

			//falta pais
			echo $_GET['callback']."(".json_encode('0').")";

		}else if ( ( isset($country[0]->country) || isset($country1) ) && ( empty($city[0]->city) && empty($city1) ) ) {

			echo $_GET['callback']."(".json_encode($country[0]->country).")";

		}else{
			//no falta nada
			echo $_GET['callback']."(".json_encode('1').")";
		}

	}

	public function addcountry(){

		$id_usuario = filter_input (INPUT_GET, 'id');
		$pais = filter_input (INPUT_GET, 'country');

		if($pais == ""){
			echo $_GET['callback']."(".json_encode('Error country void').")";
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
			echo $_GET['callback']."(".json_encode('Success insert country').")";
			return 1;
		}else {
			print_r("Error insert");
			echo $_GET['callback']."(".json_encode('Error insert country').")";
			return 0;
		}

	}else {

		$exito = DB::table('users_info')->where('users_id', $id_usuario)->update(['country' => $pais]);

		if($exito == 1){
			print_r("Exito Update");
			echo $_GET['callback']."(".json_encode('Success Update country').")";
			return 1;
		}else {
			print_r("Error Update");
			echo $_GET['callback']."(".json_encode('Error Update country').")";
			return 0;
		}
	}
}

public function addstate(){

	$id_usuario = filter_input (INPUT_GET, 'id');
	$estado = filter_input (INPUT_GET, 'state');

	if($estado == ""){
		echo $_GET['callback']."(".json_encode('Error, state void').")";
		return 0;
	}

	$existe = DB::table('users_info')->whereusers_id($id_usuario)->get()[0]->id;

	if(empty($existe)){

		$exito = DB::table('users_info')->insert(
		['users_id' => $id_usuario, 'state' => $estado]
	);

	if($exito == 1){
		echo $_GET['callback']."(".json_encode('Success insert state').")";
		return 1;
	}else {
		echo $_GET['callback']."(".json_encode('Error insert state').")";
		return 0;
	}
}else {
	$exito = DB::table('users_info')->where('users_id', $id_usuario)->update(['state' => $estado]);

	if($exito == 1){
		echo $_GET['callback']."(".json_encode('Success Update state').")";
		return 1;
	}else {
		echo $_GET['callback']."(".json_encode('Error Update state').")";
		return 0;
	}
}
}

public function addcp(){

	$id_usuario = filter_input (INPUT_GET, 'id');
	$cp = filter_input (INPUT_GET, 'codigopostal');

	$existecp = DB::table('codigospostales')->wherecodigopostal($cp)->get();

	if($cp == "" || $cp < 1000 || $cp > 99998 || empty($cp)){
		echo $_GET['callback']."(".json_encode('Error código postal invalido').")";
		return 0;
	}elseif (isset($existe)) {

		$existeus = DB::table('users_info')->whereusers_id($id_usuario)->get()[0]->id;

		if( empty($existeus) ){

			$exito = DB::table('users_info')->insert(
			['users_id' => $id_usuario, 'codigopostal' => $cp]
		);

		if($exito == 1){
			echo $_GET['callback']."(".json_encode('Success insert cp').")";
			return 1;
		}else {
			echo $_GET['callback']."(".json_encode('Error insert cp').")";
			return 0;
		}

	}else {
		$exito = DB::table('users_info')->where('users_id', $id_usuario)->update(['codigopostal' => $cp]);

		if($exito == 1){
			echo $_GET['callback']."(".json_encode('Success Update cp').")";
			return 1;
		}else {
			echo $_GET['callback']."(".json_encode('Error Update cp').")";
			return 0;
		}
	}
}
}

}
