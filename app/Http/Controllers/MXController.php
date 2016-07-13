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

		echo $_GET['callback']."(".json_encode($id_usuario).")";


		 $city = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get();
		 $city1 = DB::table('users_info')->whereusers_id($id_usuario)->get();

		$country = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get();
		$country1 = DB::table('users_info')->whereusers_id($id_usuario)->get();


		 echo $_GET['callback']."(".json_encode($city).")";
		  echo $_GET['callback']."(".json_encode('-----').")";
		 echo $_GET['callback']."(".json_encode($city1).")";
		  echo $_GET['callback']."(".json_encode('-----').")";
		 echo $_GET['callback']."(".json_encode($country).")";
		  echo $_GET['callback']."(".json_encode('-----').")";
		 echo $_GET['callback']."(".json_encode($country1).")";

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
