<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class UseController extends Controller {

	public function __construct()
	{
	}

	public function correoacurso()
	{
		$correo = \Auth::user() -> email;

		if(empty($name = DB::table('edxapp.auth_user')->whereemail($correo)->get())){
			return ("Tu correo no esta asociado a algun curso en la plataforma");
		}

		$username = $name[0]->username;
		session()->put('nombre', $username);

		if($name[0]->is_superuser == 1)
		{
			session()->put('super_user', '1');
			$id = DB::table('edxapp.auth_user')->whereemail($correo)->whereis_superuser('1')->get()[0]->id;

			$course_name = DB::table('course_name')->whereBetween('fin',array(20160000, 20990000))->whereBetween('inicio_inscripcion',array(20160000, date("Ymd")))->lists('course_name');
			return $this->index($course_name);
		}

		else if($name[0]->is_active == true)
		{

			$id = DB::table('edxapp.auth_user')->whereemail($correo)->whereis_active('1')->get()[0]->id;

			if( sizeof(DB::table('edxapp.student_courseaccessrole')->whereuser_id($id)->whererole("instructor")->where('course_id', 'like', 'course%')->get()) > 1 ){
					$course_id = DB::table('edxapp.student_courseaccessrole')->whereuser_id($id)->whererole("instructor")->where('course_id', 'like', 'course%')->get();
			}else {
				$course_id = DB::table('edxapp.student_courseaccessrole')->whereuser_id($id)->whererole("instructor")->get();
			}


			$n = sizeof($course_id);

			session()->put('accescourse', $n);
			session()->put('super_user', '0');

			for($i = 0, $j=0; $i < $n ; $i++, $j++)
			{
				$cursoid[$j] = $course_id[$i]->course_id;
				$course_name[$j] = DB::table('course_name')->wherecourse_id($cursoid[$j])->get()[0]->course_name;
			}
			if($n < 1){
				return view('accescourse')-> with('name_user', $username);

			}
			else{
				session()->put('courses_names', $course_name);
				return $this->index($course_name);
			}
		}
		else{
			return ("No tienes acceso al sistema");
		}
	}

	public function index($course_name)
	{
		$username = session()->get('nombre');

		return view('menu')->with('course_name', collect($course_name))->with('name_user', $username );
	}

	public function inscritos()
	{
		$username = session()->get('nombre');
		$course_name = filter_input (INPUT_POST, 'course_name');

		if($username == NULL)
			return $this->correoacurso();

		if($course_name){

			$course_id = DB::table('course_name')->wherecourse_name($course_name)->get()[0]->course_id;
			session()->put('course_id', $course_id);
			session()->put('course_name', $course_name);
		}

		$super_user = session()->get('super_user');

		if(($super_user == "1") && (session()->get('course_name') == 0)){

			$inscritos = DB::table('vm_inscritos_x_curso')->get();
			$cn = "Puedes ver estadísticas de los siguientes cursos:";

			$fp = fopen ('download/totales.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'id';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'nombre del curso';
			$listaid[0][3] = 'inscritos';

			$i = 1;

			foreach ($inscritos as $key => $value) {

				$listaid[$i][0] = ($value->id);
				$listaid[$i][1] = ($value->course_id);
				$listaid[$i][2] = ($value->course_name);
				$listaid[$i][3] = ($value->inscritos);

				$i++;
			}

			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);


			return view('home')->with ('inscritos', collect($inscritos)) -> with('name_user', $username )-> with('course_name', $cn);

		}
		elseif( (session()->get('accescourse') > 0) || ($super_user == "1")) {
			$course_id = session()->get('course_id');
			$course_name = session()->get('course_name');

			$inscritos = DB::table('vm_inscritos_x_curso')->wherecourse_id($course_id)->get();

			$fp = fopen ('download/totales.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'id';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'nombre del curso';
			$listaid[0][3] = 'inscritos';

			$i = 1;

			foreach ($inscritos as $key => $value) {

				$listaid[$i][0] = ($value->id);
				$listaid[$i][1] = ($value->course_id);
				$listaid[$i][2] = ($value->course_name);
				$listaid[$i][3] = ($value->inscritos);

				$i++;
			}

			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);

			return view('home')->with ('inscritos', collect($inscritos))-> with('name_user', $username )-> with('course_name', $course_name);
		}
		else
		return view('accescourse')-> with('name_user', $username);

	}

	public function cursos(){

		UseController::cursoa();
		UseController::curson();
		UseController::cursoc();

	}

	public function cursoa(){

		$super_user = session()->get('super_user');
		$username = session()->get('nombre');

		if($username == NULL)
			return $this->correoacurso();

		if($super_user == '1'){

			$activos = DB::select(DB::raw('SELECT * FROM course_name WHERE (CURDATE() <= fin AND CURDATE() >= inicio)'));
			$cn = "Puedes ver estadísticas de los siguientes cursos:";

			$fp = fopen ('download/cursoa.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'id';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'nombre del curso';
			$listaid[0][3] = 'fecha inicio';
			$listaid[0][4] = 'fecha fin';
			$listaid[0][5] = 'inicio de inscripcion';
			$listaid[0][6] = 'fin de inscripcion';
			$i = 1;
			foreach ($activos as $key => $value) {

				$listaid[$i][0] = ($value->id);
				$listaid[$i][1] = ($value->course_id);
				$listaid[$i][2] = ($value->course_name);
				$listaid[$i][3] = ($value->inicio);
				$listaid[$i][4] = ($value->fin);
				$listaid[$i][5] = ($value->inicio_inscripcion);
				$listaid[$i][6] = ($value->fin_inscripcion);
				$i++;
			}

			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);

			return view('cursoa') -> with ('activos', collect($activos))-> with('name_user', $username )-> with('course_name', $cn);
		}
		else
		return view('private')-> with('name_user', $username);
	}

	public function curson(){

		$super_user = session()->get('super_user');
		$username = session()->get('nombre');

		if($username == NULL)
			return $this->correoacurso();

		if($super_user == '1'){

			$no_activos = DB::select(DB::raw('SELECT * FROM course_name WHERE CURDATE() < inicio'));

			$cn = "Puedes ver estadísticas de los siguientes cursos:";

			$fp = fopen ('download/no_activos.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'id';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'nombre del curso';
			$listaid[0][3] = 'fecha inicio';
			$listaid[0][4] = 'fecha fin';
			$listaid[0][5] = 'inicio de inscripcion';
			$listaid[0][6] = 'fin de inscripcion';
			$i = 1;
			foreach ($no_activos as $key => $value) {

				$listaid[$i][0] = ($value->id);
				$listaid[$i][1] = ($value->course_id);
				$listaid[$i][2] = ($value->course_name);
				$listaid[$i][3] = ($value->inicio);
				$listaid[$i][4] = ($value->fin);
				$listaid[$i][5] = ($value->inicio_inscripcion);
				$listaid[$i][6] = ($value->fin_inscripcion);
				$i++;
			}

			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);

			return view('curson') -> with ('no_activos', collect($no_activos))-> with('name_user', $username )-> with('course_name', $cn);

		}
		else
		return view('private')-> with('name_user', $username);
	}

	public function cursoc(){

		$super_user = session()->get('super_user');
		$username = session()->get('nombre');

		if($username == NULL)
			return $this->correoacurso();

		if($super_user == '1'){

			$concluido = DB::select(DB::raw('SELECT * FROM course_name WHERE CURDATE() > fin'));
			$cn = "Puedes ver estadísticas de los siguientes cursos:";

			$fp = fopen ('download/cursoc.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'id';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'nombre del curso';
			$listaid[0][3] = 'fecha inicio';
			$listaid[0][4] = 'fecha fin';
			$listaid[0][5] = 'inicio de inscripcion';
			$listaid[0][6] = 'fin de inscripcion';
			$i = 1;
			foreach ($concluido as $key => $value) {

				$listaid[$i][0] = ($value->id);
				$listaid[$i][1] = ($value->course_id);
				$listaid[$i][2] = ($value->course_name);
				$listaid[$i][3] = ($value->inicio);
				$listaid[$i][4] = ($value->fin);
				$listaid[$i][5] = ($value->inicio_inscripcion);
				$listaid[$i][6] = ($value->fin_inscripcion);
				$i++;
			}

			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);

			return view('cursoc') -> with ('concluido', collect($concluido))-> with('name_user', $username )-> with('course_name', $cn);

		}
		else
		return view('private')-> with('name_user', $username);
	}

	public function totales(){

		$username = session()->get('nombre');
		$super_user = session()->get('super_user');

		if($username == NULL)
			return $this->correoacurso();

		if(($super_user == '1') && (session()->get('course_id') == null)){

			$perfil_p = DB::table('vm_perfil_usuario')
			->select('course_id', 'user_id','descripcion', 'year_of_birth', 'gender', 'level_of_education', 'mailing_address', 'city', 'country')
			->get();

			$fp = fopen('download/perfilp.csv', 'w');

			$titulop = array('Course_ID', 'User_ID' , 'Perfil profesional', 'Fecha de nacimiento', 'Genero', 'Nivel educativo', 'Codigo postal', 'Ciudad', 'Pais');
			fputcsv($fp, $titulop);

			foreach ($perfil_p as $key) {
				$array = array($key->username , $key->email, $key->descripcion, $key->year_of_birth, $key->gender, $key->level_of_education, $key->mailing_address, $key->city, $key->country);
				fputcsv($fp, $array);
			}

			fclose($fp);

			//////////////////////////////////////////////////////////////
			$date = date("Y");
			$edad15 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '>=', $date - '15')->count('id');
			$edad15_20 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '<', $date - '15')->where('year_of_birth', '>=', $date - '20')->count('id');
			$edad20_25 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '<', $date - '20')->where('year_of_birth', '>=', $date - '25')->count('id');
			$edad25_30 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '<', $date - '25')->where('year_of_birth', '>=', $date - '30')->count('id');
			$edad30_35 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '<', $date - '30')->where('year_of_birth', '>=', $date - '35')->count('id');
			$edad35_40 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '<', $date - '35')->where('year_of_birth', '>=', $date - '40')->count('id');
			$edad40_45 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '<', $date - '40')->where('year_of_birth', '>=', $date - '45')->count('id');
			$edad45_50 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '<', $date - '45')->where('year_of_birth', '>=', $date - '50')->count('id');
			$edad50 = DB::table('edxapp.auth_userprofile')->where('year_of_birth', '<', $date - '50')->count('id');

			$edad = array($edad15,$edad15_20,$edad20_25,$edad25_30,$edad30_35,$edad35_40,$edad40_45,$edad45_50,$edad50);

			$fp = fopen ('download/edades.csv', 'w');
			$edad00 = array('Menores a 15', 'Entre 16 y 20', 'Entre 21 y 25', 'Entre 26 y 30', 'Entre 31 y 35', 'Entre 36 y 40', 'Entre 41 y 45', 'Entre 46 y 50', 'Más de 50');
			$z = 0;
			$e  = array('Rango edad', 'Cantidad');
			fputcsv($fp, $e);
			foreach ($edad as $key) {
				$e  = array($edad00[$z], $key);
				fputcsv($fp, $e);
				$z++;
			}

			fclose($fp);
			//////////////////////////////////////////////////////////////

			$f = DB::table('edxapp.auth_userprofile')->wheregender("f")->count();
			$m = DB::table('edxapp.auth_userprofile')->wheregender("m")->count();
			$n = DB::table('edxapp.auth_userprofile')->wheregender("")->count();
			$infot = array($f, $m, $n);

			$fp = fopen ('download/genero.csv', 'w');

			$var = array('Genero', 'Cantidad');
			fputcsv($fp, $var);

			$mujeres = array('Mujeres', $f);
			fputcsv($fp, $mujeres);

			$hombres = array('Hombres', $m);
			fputcsv($fp, $hombres);

			$no_definidos = array('No definidos', $n);
			fputcsv($fp, $no_definidos);

			fclose($fp);

			//////////////////////////////////////////////////////////////////////////

			$d = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('p')->select('id')->count();
			$m = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('m')->select('id')->count();
			$t = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('a')->select('id')->count();
			$l = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('b')->select('id')->count();
			$p = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('hs')->select('id')->count();
			$s = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('jhs')->select('id')->count();
			$pr = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('el')->select('id')->count();
			$n = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('none')->select('id')->count();
			$o = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('other')->select('id')->count();
			$ne = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('')->select('id')->count();
			$dc = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('p_se')->select('id')->count();
			$do = DB::table('edxapp.auth_userprofile')->wherelevel_of_education('p_oth')->select('id')->count();

			$d = $d + $dc + $do;

			$estudio = array($d, $m, $t, $l, $p, $s, $pr, $n, $o, $ne);

			$fp = fopen ('download/nivel.csv', 'w');
			$estudios = array('Doctorado', 'Maestria', 'Técnico Superior', 'Licenciatura', 'Bachillerato', 'Secundaria', 'Primaria', 'Ninguno', 'Otros', 'No especificado');
			$w = 0;
			$es  = array('Grado de estudio', 'Cantidad');
			fputcsv($fp, $es);

			foreach ($estudio as $key) {
				$es  = array($estudios[$w], $key);
				fputcsv($fp, $es);
				$w++;
			}

			fclose($fp);

			//////////////////////////////////////////////////////////////////////////

			$t = DB::table('edxapp.auth_user')->count('id');
			$n = DB::table('edxapp.auth_user')->whereis_active('0')->count('id');
			$a = DB::table('edxapp.auth_user')->whereis_active('1')->count('id');

			$info = array($t, $n, $a);

			$fp = fopen ('download/totales.csv', 'w');

			$info1 = array('Usuarios', 'Cantidad');
			fputcsv($fp, $info1);

			$info1 = array('Registrados en MéxicoX' ,$info[0]);
			fputcsv($fp, $info1);

			$info1 = array('Usuarios con cuenta activada en MéxicoX' ,$info[1] );
			fputcsv($fp, $info1);

			$info1 = array('Usuarios que no tienen su cuenta activada en MéxicoX', $info[2]);
			fputcsv($fp, $info1);
			fclose($fp);

			$cn ="MéxicoX";
			$cn0 = "Registrados en MéxicoX";
			$cn1 = "Usuarios con cuenta activada en MéxicoX";
			$cn2 = "Usuarios que no tienen su cuenta activada en MéxicoX";

			return view('usuarios/totales')-> with ('info', collect($info)) -> with ('edad', collect($edad))->with('infot', collect($infot))->with ('estudio', collect($estudio))->with('name_user', $username )-> with('course_name0', $cn0)-> with('course_name1', $cn1)-> with('course_name2', $cn2)-> with('course_name', $cn);

		}

		elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

			$course_id = session()->get('course_id');

			if(!$course_id)
			{
				return $this->correoacurso();
			}

			// $perfil_p = DB::table('auth_perfilusuario')
			$perfil_p = DB::table('vm_perfil_usuario')->wherecourse_id($course_id)
				->select('descripcion', 'year_of_birth', 'gender', 'level_of_education', 'mailing_address', 'city', 'country')
				->get();

				$fp = fopen('download/perfilp.csv', 'w');

				$titulop = array('Perfil profesional', 'Fecha de nacimiento', 'Genero', 'Nivel educativo', 'Codigo postal', 'Ciudad', 'Pais');
				fputcsv($fp, $titulop);

				foreach ($perfil_p as $key) {
					$array = array($key->username , $key->email, $key->descripcion, $key->year_of_birth, $key->gender, $key->level_of_education, $key->mailing_address, $key->city, $key->country);
					fputcsv($fp, $array);
				}

				fclose($fp);

			////////////////////////////////////////////////////////////////////////////////////////////////
			$date = date("Y");
			$edad15 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '>=', $date - '15')->select('id')->count();
			$edad15_20 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '15')->where('year_of_birth', '>=', $date - '20')->select('id')->count();
			$edad20_25 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '20')->where('year_of_birth', '>=', $date - '25')->select('id')->count();
			$edad25_30 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '25')->where('year_of_birth', '>=', $date - '30')->select('id')->count();
			$edad30_35 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '30')->where('year_of_birth', '>=', $date - '35')->select('id')->count();
			$edad35_40 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '35')->where('year_of_birth', '>=', $date - '40')->select('id')->count();
			$edad40_45 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '40')->where('year_of_birth', '>=', $date - '45')->select('id')->count();
			$edad45_50 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '45')->where('year_of_birth', '>=', $date - '50')->select('id')->count();
			$edad50 = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '50')->select('id')->count();

			$edad = array($edad15,$edad15_20,$edad20_25,$edad25_30,$edad30_35,$edad35_40,$edad40_45,$edad45_50,$edad50);

			$fp = fopen ('download/edades.csv', 'w');
			$edad00 = array('Menores a 15', 'Entre 16 y 20', 'Entre 21 y 25', 'Entre 26 y 30', 'Entre 31 y 35', 'Entre 36 y 40', 'Entre 41 y 45', 'Entre 46 y 50', 'Más de 50');
			$z = 0;
			$e  = array('Rango edad', 'Cantidad');
			fputcsv($fp, $e);
			foreach ($edad as $key) {
				$e  = array($edad00[$z], $key);
				fputcsv($fp, $e);
				$z++;
			}

			fclose($fp);
			///////////////////////////////////////////////////////////////////////////////////////////

			$m = DB::table('edxapp.student_courseenrollment')->join('edxapp.auth_userprofile', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wheregender('m')->count();
			$f = DB::table('edxapp.student_courseenrollment')->join('edxapp.auth_userprofile', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wheregender('f')->count();
			$n = DB::table('edxapp.student_courseenrollment')->join('edxapp.auth_userprofile', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wheregender('')->count();

			$infot = array($f, $m, $n);

			$fp = fopen ('download/genero.csv', 'w');

			$var = array('Genero', 'Cantidad');
			fputcsv($fp, $var);

			$mujeres = array('Mujeres', $f);
			fputcsv($fp, $mujeres);

			$hombres = array('Hombres', $m);
			fputcsv($fp, $hombres);

			$no_definidos = array('No definidos', $n);
			fputcsv($fp, $no_definidos);

			fclose($fp);

			//////////////////////////////////////////////////////////////////////////

			$d = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('p')->select('id')->count();
			$m = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('m')->select('id')->count();
			$t = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('a')->select('id')->count();
			$l = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('b')->select('id')->count();
			$p = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('hs')->select('id')->count();
			$s = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('jhs')->select('id')->count();
			$pr = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('el')->select('id')->count();
			$n = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('none')->select('id')->count();
			$o = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('other')->select('id')->count();
			$ne = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('')->select('id')->count();
			$dc = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('p_se')->select('id')->count();
			$do = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('p_oth')->select('id')->count();

			$d = $d + $dc + $do;

			$estudio1 = array('Doctorado' => $d, 'Maestria' => $m, 'Técnico Superior' => $t, 'Licenciatura' => $l, 'Bachillerato' => $p, 'Secundaria' => $s, 'Primaria' => $pr, 'Ninguno' => $n, 'Otros' =>  $o, 'No especificado' => $ne);
			$estudio = array($d, $m, $t, $l, $p, $s, $pr, $n, $o, $ne);

			$fp = fopen ('download/nivel.csv', 'w');
			$estudios = array('Doctorado', 'Maestria', 'Técnico Superior', 'Licenciatura', 'Bachillerato', 'Secundaria', 'Primaria', 'Ninguno', 'Otros', 'No especificado');
			$w = 0;
			$es  = array('Grado de estudio', 'Cantidad');
			fputcsv($fp, $es);

			foreach ($estudio as $key) {
				$es  = array($estudios[$w], $key);
				fputcsv($fp, $es);
				$w++;
			}

			fclose($fp);


			/////////////////////////////////////////////////////////////////////////////

			$t = DB::table('edxapp.auth_user')->count('id');
			$inscritos = DB::table('edxapp.student_courseenrollment')->wherecourse_id($course_id)->whereis_active('1')->count('id');

			$n = $t-$inscritos;
			$info = array($t, $n, $inscritos);
			$course_name = session()->get('course_name');

			$fp = fopen ('download/totales.csv', 'w');

			$info1 = array('Usuarios', 'Cantidad');
			fputcsv($fp, $info1);

			$info1 = array('Activos en MéxicoX' ,$info[0]);
			$c_name0 = "Activos en MéxicoX";
			fputcsv($fp, $info1);

			$info1 = array('Activos en '. $course_name ,$info[1] );
			$c_name1 = "Inscritos en ".$course_name;
			fputcsv($fp, $info1);

			$info1 = array('No activos en '. $course_name, $info[2]);
			$c_name2 = "No inscritos en ".$course_name;
			fputcsv($fp, $info1);
			fclose($fp);

			return view('usuarios/totales') -> with ('info', collect($info)) -> with ('edad', collect($edad))->with ('infot', collect($infot))->with ('estudio', collect($estudio))->with('name_user', $username )-> with('course_name', $course_name)-> with('course_name0', $c_name0)-> with('course_name1', $c_name1)-> with('course_name2', $c_name2);

		}
		else
		return view('accescourse')-> with('name_user', $username);
	}

	public function infocurso(){

		$super_user = session()->get('super_user');
		$course_name = session()->get('course_name');
		$course_id = session()->get('course_id');
		$username = session()->get('nombre');

		if($username == NULL)
			return $this->correoacurso();

		if( session()->get('course_name') == NULL){
			return $this->correoacurso();

		}
		elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

			if(DB::table('edxapp.student_courseenrollment')->wherecourse_id($course_id)->orderBy('created', 'asc')->lists('created'))
			{
				$semanal = DB::table('edxapp.student_courseenrollment')->wherecourse_id($course_id)->orderBy('created', 'asc')->lists('created');

			}
			else {
				$semanal = array();
				$semanal[0] = '2000-01-01 00:00:00';
			}


			$w = (int)date("Weeknumber: W", strtotime($semanal[0]));
			$s = date($semanal[0]);

			$i = 0;
			$k=0;
			$l=0;
			$sem = array('Semana', 'Registrados');
			$sem1 = array();

				$fp = fopen ('download/semanal.csv', 'w');
				fputcsv($fp, $sem);

			foreach ($semanal as $value) {

				if($w == (int)date("Weeknumber: W", strtotime($value))){
					$k++;

				}
				else {
					$sem1[$i]= $k;
					$i++;
					$sem = array($i ,$k);
					fputcsv($fp, $sem);
					$k=1;

				}
				$l++;

				$w = (int)date("Weeknumber: W", strtotime($value));
				$f = $value;

			}


			fclose($fp);

///////////////////////////////////////////////////////////////////////

		$fdesercion = fopen ('download/desercion.csv', 'w');
		$fhistorico = fopen ('download/historico.csv', 'w');

		$dese = array('Día', 'Alumnos con actividad');
		$historic = array('Día', 'Acumulado');

		fputcsv($fdesercion, $dese);
		fputcsv($fhistorico, $historic);

		$desercion = DB::table('vm_desercion')->wherecourse_name($course_name)->get();
		$i = 1;
		$histo = 0;

		foreach ($desercion as $value) {

			$fila = array($i , $value->usuarios);

			$histo = $histo + $value->usuarios;
			$history = array($i , $histo);

		fputcsv($fdesercion, $fila);
		fputcsv($fhistorico, $history);
		$i++;
		}


		fclose($fdesercion);
		fclose($fhistorico);
/////////////////////////////////////////////////////////////////////





			$json = json_encode ($desercion);

			return view('usuarios/infocurso') -> with('desercion', $json)->with('name_user', $username )-> with('course_name', $course_name)->with('semanal', collect($sem1))->with('s', $s)->with('f', $f)->with('l', $l);
		}
		else{

			$username = session()->get('nombre');
			return view('accescourse')-> with('name_user', $username);
		}
	}

	public function inscritost(){

		$username = session()->get('nombre');
		$super_user = session()->get('super_user');

		if($username == NULL)
			return $this->correoacurso();

		if(($super_user == '1')){

			$mes1 = DB::select(DB::raw('SELECT count(id) as cuenta FROM edxapp.auth_user WHERE YEAR(date_joined) = 2015 GROUP BY MONTH(date_joined)'));

			$i = 0;
			foreach ($mes1 as $m){
				$mes[$i] = $m->cuenta;
				$i++;
			}
			$mes2 = DB::select(DB::raw('SELECT count(id) as cuenta FROM edxapp.auth_user WHERE YEAR(date_joined) = 2016 GROUP BY MONTH(date_joined)'));

			$i = sizeof($mes);
			foreach ($mes2 as $m){
				$mes[$i] = $m->cuenta;
				$i++;
			}

			$cur1 = DB::select(DB::raw('SELECT count(id) as c FROM edxapp.student_courseenrollment where year(created) = 2015 group by month(created)'));
			$i = 0;
			foreach ($cur1 as $c1){
				$cur[$i] = $c1->c;
				$i++;
			}
			$cur2 = DB::select(DB::raw('SELECT count(id) as c FROM edxapp.student_courseenrollment where year(created) = 2016 group by month(created)'));
			$i = sizeof($cur);
			foreach ($cur2 as $c2){
				$cur[$i] = $c2->c;
				$i++;
			}
/////////////////////////////////////////////////

			$ins = fopen ('download/inscritos.csv', 'w');

			$j=1;

			$registros1 = array ('Mes', 'Registrados');
			fputcsv($ins, $registros1);

			foreach ($mes as $u){

				$registros1 = array ($j, $u);
				fputcsv($ins, $registros1);
				$j++;
			}

			fclose($ins);

/////////////////////////////////////7
			$reg = fopen ('download/registrados.csv', 'w');

			$j=1;

			$registros2 = array ('Mes', 'Registrados');
			fputcsv($reg, $registros2);

			foreach ($cur as $u){

				$registros2 = array ($j, $u);
				fputcsv($reg, $registros2);
				$j++;
			}


			fclose($reg);

//////////////////////////////////////////////////////

			$users_course = DB::select(DB::raw('SELECT count(n) as users, n FROM vm_count_user_course group by n'));

			$us = fopen ('download/usuarios_curso.csv', 'w');

			$i = 0;
			$registros = array ();

			foreach ($users_course as $u){
				$registro = array ($u->n, $u->users);
				fputcsv($us, $registro);
			}

			fclose($us);

			////////////////////////////////////////////////////////////////////////////

			$efi = fopen ('download/eficiencia_cursos.csv', 'w');

			$constancias = DB::table('mexicox.constancias')->count('id');
			$lista_constancias = array();
			$lista_constancias = DB::select(DB::raw('select count(curso) as constancias , course_id as nombre_curso from mexicox.constancias group by course_id'));
			$r = 0;

			$eficiencia = array('Id del curso', 'Constancias emitidas', 'Inscritos', 'Eficiencia en porcentaje');
			fputcsv($efi, $eficiencia);

			foreach ($lista_constancias as $key){

			$inscrito_curso[$r] = DB::table('vm_inscritos_x_curso')->wherecourse_id($key->nombre_curso)->get();

			if($inscrito_curso[$r] == NULL){
						$eficiencia = array ($lista_constancias[$r]->nombre_curso, $key->constancias, '0000', '0' );
			}
			else if($inscrito_curso[$r][0]->course_name){
						$eficiencia = array ($inscrito_curso[$r][0]->course_name , $key->constancias, $inscrito_curso[$r][0]->inscritos, ($key->constancias/($inscrito_curso[$r][0]->inscritos)*100));
			}
			else if($lista_constancias[$r]->nombre_curso){
						$eficiencia = array ($lista_constancias[$r]->nombre_curso , $key->constancias, $inscrito_curso[$r][0]->inscritos, ($key->constancias/($inscrito_curso[$r][0]->inscritos)*100));
			}


			fputcsv($efi, $eficiencia);

			$r++;
			}

			fclose($efi);

			///////////////////////////////////////////////////////////////////////////

			$ncursos_constancia = DB::select(DB::raw('SELECT count(correo) as n FROM mexicox.constancias group by correo order by n asc'));

			$usc = fopen ('download/usuarios_curso_constancia.csv', 'w');

			$b = 1;
			$inscritos_nc[0] = 0;
			$inscritos_nc[1] = 1;
			$nn[0] = $ncursos_constancia[0]->n;
			$j = 1;
			$registroc = array();

			foreach($ncursos_constancia as $n){
				#print_r($n->n);
				 if($n->n == $b){
				 	$inscritos_nc[$b]++;
				 }
				 else {
					$registroc = array ($b ,$inscritos_nc[$b]);
					fputcsv($usc, $registroc);
				 	$b = $n->n;
					$nn[$j] = $n->n;
					$inscritos_nc[$b] = 1;
					$j++;

				 }
			}
			$registroc = array ($b ,$inscritos_nc[$b]);
			fputcsv($usc, $registroc);

			fclose($usc);

			$n_instructores = DB::select(DB::raw('SELECT count(*) as n FROM edxapp.student_courseaccessrole where role = "instructor"'))[0]->n;


			return view('usuarios/inscritost')-> with('mes1', collect($mes))-> with('mes2', collect($cur))-> with('name_user', $username)->with('users_course', collect($users_course))->with('constancias', $constancias)->with('lista_constancias', $lista_constancias)->with('inscrito_curso', $inscrito_curso)->with('inscritos_nc', $inscritos_nc)->with('nn', $nn)->with('n_instructores', $n_instructores);

		}
		else
		return view('private')-> with('name_user', $username);
	}



	public function geo(){

		$super_user = session()->get('super_user');
		$course_name = session()->get('course_name');
		$course_id = session()->get('course_id');
		$username = session()->get('nombre');

		if($username == NULL)
			return $this->correoacurso();

		if(($super_user == '1') && (session()->get('course_name') == null))
		{

			$AG = DB::table('edxapp.auth_userprofile')->wherecountry('AG')->select('id')->count();
			$BC = DB::table('edxapp.auth_userprofile')->wherecountry('BC')->select('id')->count();
			$BS = DB::table('edxapp.auth_userprofile')->wherecountry('BS')->select('id')->count();
			$CC = DB::table('edxapp.auth_userprofile')->wherecountry('CC')->select('id')->count();
			$CS = DB::table('edxapp.auth_userprofile')->wherecountry('CS')->select('id')->count();
			$CH = DB::table('edxapp.auth_userprofile')->wherecountry('CH')->select('id')->count();
			$CL = DB::table('edxapp.auth_userprofile')->wherecountry('CL')->select('id')->count();
			$CM = DB::table('edxapp.auth_userprofile')->wherecountry('CM')->select('id')->count();
			$DF = DB::table('edxapp.auth_userprofile')->wherecountry('DF')->select('id')->count();
			$DG = DB::table('edxapp.auth_userprofile')->wherecountry('DG')->select('id')->count();
			$GT = DB::table('edxapp.auth_userprofile')->wherecountry('GT')->select('id')->count();
			$GR = DB::table('edxapp.auth_userprofile')->wherecountry('GR')->select('id')->count();
			$HG = DB::table('edxapp.auth_userprofile')->wherecountry('HG')->select('id')->count();
			$JC = DB::table('edxapp.auth_userprofile')->wherecountry('JC')->select('id')->count();
			$MC = DB::table('edxapp.auth_userprofile')->wherecountry('MC')->select('id')->count();
			$MN = DB::table('edxapp.auth_userprofile')->wherecountry('MN')->select('id')->count();
			$MS = DB::table('edxapp.auth_userprofile')->wherecountry('MS')->select('id')->count();
			$NT = DB::table('edxapp.auth_userprofile')->wherecountry('NT')->select('id')->count();
			$NL = DB::table('edxapp.auth_userprofile')->wherecountry('NL')->select('id')->count();
			$OC = DB::table('edxapp.auth_userprofile')->wherecountry('OC')->select('id')->count();
			$PL = DB::table('edxapp.auth_userprofile')->wherecountry('PL')->select('id')->count();
			$QT = DB::table('edxapp.auth_userprofile')->wherecountry('QT')->select('id')->count();
			$QR = DB::table('edxapp.auth_userprofile')->wherecountry('QR')->select('id')->count();
			$SP = DB::table('edxapp.auth_userprofile')->wherecountry('SP')->select('id')->count();
			$SL = DB::table('edxapp.auth_userprofile')->wherecountry('SL')->select('id')->count();
			$SR = DB::table('edxapp.auth_userprofile')->wherecountry('SR')->select('id')->count();
			$TC = DB::table('edxapp.auth_userprofile')->wherecountry('TC')->select('id')->count();
			$TS = DB::table('edxapp.auth_userprofile')->wherecountry('TS')->select('id')->count();
			$TL = DB::table('edxapp.auth_userprofile')->wherecountry('TL')->select('id')->count();
			$VZ = DB::table('edxapp.auth_userprofile')->wherecountry('VZ')->select('id')->count();
			$YN = DB::table('edxapp.auth_userprofile')->wherecountry('YN')->select('id')->count();
			$ZS = DB::table('edxapp.auth_userprofile')->wherecountry('ZS')->select('id')->count();
			$EX = DB::table('edxapp.auth_userprofile')->wherecountry('EX')->select('id')->count();

			$total = $AG + $BC + $BS + $CC + $CS + $CH + $CL + $CM + $DF + $DG + $GT + $GR + $HG + $JC + $MC + $MN + $MS + $NT + $NL + $OC + $PL + $QT + $QR + $SP + $SL + $SR + $TC + $TS + $TL + $VZ + $YN + $ZS + $EX;
			$geo = array($AG, $BC, $BS, $CC, $CS, $CH, $CL, $CM, $DF, $DG, $GT, $GR, $HG, $JC, $MC, $MN, $MS, $NT, $NL, $OC, $PL, $QT, $QR, $SP, $SL, $SR, $TC, $TS, $TL, $VZ, $YN, $ZS, $EX, $total);

			$cn = "Estadísticas todos los cursos:";

			return view('usuarios/geo') -> with('geo', collect($geo))-> with('name_user', $username )-> with('course_name', $cn);

		}elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

			$AG = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('AG')->select('id')->count();
			$BC = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('BC')->select('id')->count();
			$BS = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('BS')->select('id')->count();
			$CC = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CC')->select('id')->count();
			$CS = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CS')->select('id')->count();
			$CH = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CH')->select('id')->count();
			$CL = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CL')->select('id')->count();
			$CM = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CM')->select('id')->count();
			$DF = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('DF')->select('id')->count();
			$DG = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('DG')->select('id')->count();
			$GT = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('GT')->select('id')->count();
			$GR = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('GR')->select('id')->count();
			$HG = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('HG')->select('id')->count();
			$JC = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('JC')->select('id')->count();
			$MC = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('MC')->select('id')->count();
			$MN = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('MN')->select('id')->count();
			$MS = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('MS')->select('id')->count();
			$NT = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('NT')->select('id')->count();
			$NL = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('NL')->select('id')->count();
			$OC = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('OC')->select('id')->count();
			$PL = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('PL')->select('id')->count();
			$QT = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('QT')->select('id')->count();
			$QR = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('QR')->select('id')->count();
			$SP = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('SP')->select('id')->count();
			$SL = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('SL')->select('id')->count();
			$SR = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('SR')->select('id')->count();
			$TC = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('TC')->select('id')->count();
			$TS = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('TS')->select('id')->count();
			$TL = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('TL')->select('id')->count();
			$VZ = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('VZ')->select('id')->count();
			$YN = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('YN')->select('id')->count();
			$ZS = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('ZS')->select('id')->count();
			$EX = DB::table('edxapp.auth_userprofile')->join('edxapp.student_courseenrollment', 'edxapp.student_courseenrollment.user_id', '=', 'edxapp.auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('EX')->select('id')->count();

			$total = $AG + $BC + $BS + $CC + $CS + $CH + $CL + $CM + $DF + $DG + $GT + $GR + $HG + $JC + $MC + $MN + $MS + $NT + $NL + $OC + $PL + $QT + $QR + $SP + $SL + $SR + $TC + $TS + $TL + $VZ + $YN + $ZS + $EX;
			$geo = array($AG, $BC, $BS, $CC, $CS, $CH, $CL, $CM, $DF, $DG, $GT, $GR, $HG, $JC, $MC, $MN, $MS, $NT, $NL, $OC, $PL, $QT, $QR, $SP, $SL, $SR, $TC, $TS, $TL, $VZ, $YN, $ZS, $EX, $total);

			return view('usuarios/geo') -> with('geo', collect($geo))->with('name_user', $username )-> with('course_name', $course_name);

		}
		else
		return view('accescourse')-> with('name_user', $username);

	}

	public function videos(){

		$super_user = session()->get('super_user');
		$course_name = session()->get('course_name');
		$course_id = session()->get('course_id');
		$username = session()->get('nombre');

		if($username == NULL)
			return $this->correoacurso();

		if( session()->get('course_name') == NULL){
			return $this->correoacurso();

		}
		elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

			$videos = DB::table('vm_videos')->wherecourse_id($course_id)->wheremodule_type('video')->groupBy('module_id')->lists('module_id');
			#$videos = DB::table('courseware_studentmodule')->wherecourse_id($course_id)->wheremodule_type('video')->groupBy('module_id')->lists('module_id');

			if( !$videos)
			return view('videos/accesvideos')-> with('name_user', $username);


			for($w = 0 ; $w < sizeof($videos) ; $w++)
			$segmax[$w] = 0;
			$a = 0;
			foreach ($videos as $val) {
				$v = DB::table('vm_videos')->wheremodule_id($val)->lists('state');
				$n = 0;
				$suma_s = 0;

				foreach ($v as $value) {

					//
					// $sub = "saved_video_position";
					// $pos = strpos($value, $sub);
					// $rest = substr ($value, ($pos+24));
					// $time = substr($rest, 0, -2);

					if($value == NULL)
					$value = '00:00:00';
					if($value != '00:00:00'){
						list($horas, $minutos, $segundos) = explode(':', $value);
						$seg = ($horas * 60 ) + $minutos + ($segundos/60);

						if($segmax[$a] < $seg){
							$segmax[$a] = $seg;
						}
						$suma_s = $suma_s + $seg;
						$n++;
					}
				}
				if($n != 0)
				$promedio[$a] = $suma_s/$n;
				else {
					$promedio[$a] = 0;
				}


				$a++;

			}

			return view('videos/videos') -> with('promedio', collect($promedio))->with('name_user', $username )-> with('course_name', $course_name)->with('nvideo', collect($segmax));
		}

	}

	public function mongo(){

			print_r("Hola MongoDB");

			#$prueba = DB::connection('mongodb')->collection('assetstore')->get();
			$prueba = MongoTest::all();
			print_r($prueba);

	}

	public function logout(){
		session()->flush();

		return view('logout');
	}
}
