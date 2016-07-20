<?php

namespace App\Http\Controllers;
use DB;
use File;
use Illuminate\Http\Request;

class MXController extends Controller {

	public function __construct()
	{
	}

	public function validarcp(){

		$codigo = filter_input(INPUT_GET, 'codigopostal');

		$direccion = DB::table('codigospostales')->wherecodigopostal($codigo)->get();

		if(empty($direccion)){
			echo $_GET['callback']."(".json_encode('0').")";

		}else {
			echo $_GET['callback']."(".json_encode($direccion).")";
		}

	}

	public function verifica(){

		$id_usuario = filter_input(INPUT_GET, 'id');

		$city = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get();
		//$city1 = DB::table('users_info')->whereusers_id($id_usuario)->get();

		$country = DB::table('auth_userprofile')->whereuser_id($id_usuario)->get();
		//$country1 = DB::table('users_info')->whereusers_id($id_usuario)->get();


		if( empty($country[0]->country) || ( $country[0]->country == NULL ) ){

			//falta pais
			echo $_GET['callback']."(".json_encode('0').")";

		}else if ( ( isset($country[0]->country)  ) && ( ( empty($city[0]->city) ) || ( $city[0]->city == NULL ) ) ) {

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

			$exito = DB::table('auth_userprofile')->where('user_id', $id_usuario)->update(['country' => $pais, 'city' => $estado, 'mailing_address' => $cp]);

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

public function uploadvideo(){

	return view('upload.uploadvideo');
}

public function savevideo(Request $request){

	$this->validate($request, [

		'inputEmai'  => 'required|email|max:150',
		'inputText'  => 'required|string|max:1000',
		'inputVideo'  => 'required|max:20000',

	]);

	$video = $request->file('inputVideo');
	$texto = $request->input('inputText');
	$email = $request->input('inputEmai');

	$id = DB::table('upload_video')->max('id');

	\Storage::MakeDirectory($id);

	$vid = $video->getClientOriginalName();

	$route1 = \Storage::disk('local')->put($id.'/'.$vid, File::get($video));

		$exito = DB::table('upload_video')->insert(
		[
			'correo' => $email,
			'texto' => $texto,
			'ruta_video' => '/public/uploadvodeos/'.$id.'',
			]
		);

		if($exito == 1 ){
			return "Gracias";
		}else {
			return "Ocurrio un error al subir el video.";
		}

}

}
