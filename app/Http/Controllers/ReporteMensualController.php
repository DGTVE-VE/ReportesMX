<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Model\Course_overviews;
use App\Model\Auth_user;

class ReporteMensualController extends Controller {

	public function __construct()
	{
	}


	public function getreporteMensual(Request $request){

		$name_user = session()->get('nombre');

		$this->validate($request, [
			 'fecha_inicio' => 'required|date',
			 'fecha_fin' => 'required|date'
	 	]);

		if($request->fecha_inicio >= date("Y-m-d"))
		{
			\Session::flash('message', 'No puede ser una fecha mayor o igual a la de hoy!');
			return view('reporteMensual')
			-> with('name_user', $name_user);
		}
		else if($request->fecha_fin > date("Y-m-d") ) {
			\Session::flash('message', 'No puede ser una fecha mayor a la de hoy!');
			return view('reporteMensual')
			-> with('name_user', $name_user);
		}
		else if($request->fecha_fin < $request->fecha_inicio) {
			\Session::flash('message', 'No puede ser una fecha_fin menor a la fecha_inicio!');
			return view('reporteMensual')
			-> with('name_user', $name_user);
		}

		// $constancias =

		// $inscritos_cursos =

		$inscritos_totales =DB::select(DB::raw('select count(id) as c, month(date_joined) as m from `edxapp`.`auth_user`
																where `is_active` = "1"
																and `date_joined` >= "'.$request->fecha_inicio.
																'" and `date_joined` <= "'.$request->fecha_fin.
																'" group by month(date_joined)
																order by month(date_joined) asc'));


		$inscritos_curso =DB::select(DB::raw('select count(id) as c, month(created) as m from `edxapp`.`student_courseenrollment`
																where `is_active` = "1"
																and `created` >= "'.$request->fecha_inicio.
																'" and `created` <= "'.$request->fecha_fin.
																'" group by month(created)
																order by month(created) asc'));

		$constancias = DB::select(DB::raw('select count(id) as c, month(created_date) as m from `edxapp`.`certificates_generatedcertificate`
																where `status` = "downloadable"
																and `created_date` >= "'.$request->fecha_inicio.
																'" and `created_date` <= "'.$request->fecha_fin.
																'" group by month(created_date)
																order by month(created_date) asc'));

		// return $request->fecha_inicio;

		return view('reporteMensual')
		-> with('name_user', $name_user)
		-> with('constancias', collect($constancias))
		-> with('inscritos_curso', collect($inscritos_curso))
		-> with('inscritos_totales', collect($inscritos_totales));
	}

	public function reporteMensual(){

		$name_user = session()->get('nombre');


		return view('reporteMensual')
		-> with('name_user', $name_user);
	}

}
