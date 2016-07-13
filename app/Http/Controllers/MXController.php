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

	public function adddata(){

		$id_usuario = filter_input (INPUT_GET, 'id');
		$pais = filter_input (INPUT_GET, 'country');
		$estado = filter_input (INPUT_GET, 'state');
		$cp = filter_input (INPUT_GET, 'codigopostal');

		if(empty($pais)){
			echo $_GET['callback']."(".json_encode('Error country void').")";
			return 0;
		}
		else if(empty($estado)){
			echo $_GET['callback']."(".json_encode('Error state void').")";
			return 0;
		}
		else if(empty($cp)){
			echo $_GET['callback']."(".json_encode('Error cp void').")";
			return 0;
		}else {

			if($pais == "MX"){
				$codigo = DB::table('codigospostales')->wherecodigopostal($cp)->get();
				if(empty($codigo)){
					echo $_GET['callback']."(".json_encode('Error invalid cp').")";
					return 0;
				}
			}

			$existe = DB::table('users_info')->whereusers_id($id_usuario)->get();

			if(empty($existe)){

				$exito = DB::table('users_info')->insert(
				['users_id' => $id_usuario, 'country' => $pais , 'state' => $estado, 'cp' => $cp]
			);

			if($exito == 1){
				print_r("Exito insert");
				echo $_GET['callback']."(".json_encode('Success Insert').")";
				return 1;
			}else {
				print_r("Error insert");
				echo $_GET['callback']."(".json_encode('Error Insert').")";
				return 0;
			}
		}else {

			$exito = DB::table('users_info')->where('users_id', $id_usuario)->update(['country' => $pais, 'state' => $estado, 'codigopostal' => $cp]);

			if($exito == 1){
				print_r("Exito Update");
				echo $_GET['callback']."(".json_encode('Success Update').")";
				return 1;
			}else {
				print_r("Error Update");
				echo $_GET['callback']."(".json_encode('Error Update').")";
				return 0;
			}
		}
	}
}
}
