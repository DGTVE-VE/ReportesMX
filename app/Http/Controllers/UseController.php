<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Model\Course_overviews;
use App\Model\Auth_userprofile;

class UseController extends Controller {

	public function __construct()
	{
	}

	public function correoacurso()
	{
		$correo = \Auth::user() -> email;

		if(empty($name = DB::table('edxapp.auth_user')->whereemail($correo)->get())){
			return view('no_asociado_curso');
		}

		$username = $name[0]->username;
		session()->put('nombre', $username);

		if($name[0]->is_superuser == 1)
		{
			session()->put('super_user', '1');
			$id = DB::table('edxapp.auth_user')->whereemail($correo)->whereis_superuser('1')->get()[0]->id;

			$course_name = Course_overviews::whereBetween('end',array(20160000, 20990000))
                                ->whereBetween('enrollment_start',array(20160000, date("Ymd")))
                                ->lists('display_name');
			$cursoid = Course_overviews::whereBetween('end',array(20160000, 20990000))
			                          ->whereBetween('enrollment_start',array(20160000, date("Ymd")))
			                          ->lists('id');
			return $this->index($course_name,$cursoid);
		}

		else if($name[0]->is_active == true)
		{

			$id = DB::table('edxapp.auth_user')->whereemail($correo)->whereis_active('1')->get()[0]->id;

			if( sizeof(DB::table('edxapp.student_courseaccessrole')
                                ->whereuser_id($id)
                                ->whererole("instructor")
                                ->where('course_id', 'like', 'course%')->get()) > 1 ){
					$course_id = DB::table('edxapp.student_courseaccessrole')
                                                ->whereuser_id($id)
                                                ->whererole("instructor")
                                                ->where('course_id', 'like', 'course%')
                                                ->get();
			}else {
				$course_id = DB::table('edxapp.student_courseaccessrole')
                                        ->whereuser_id($id)
                                        ->whererole("instructor")
                                        ->get();
			}


			$n = sizeof($course_id);

			session()->put('accescourse', $n);
			session()->put('super_user', '0');

			for($i = 0, $j=0; $i < $n ; $i++, $j++)
			{
				$cursoid[$j] = $course_id[$i]->course_id;
				$course_name[$j] = Course_overviews::whereid($cursoid[$j])->get()[0]->display_name;
			}
			if($n < 1){
				return view('accescourse')-> with('name_user', $username);
			}
			else{
				session()->put('courses_names', $course_name);
				return $this->index($course_name, $cursoid);
			}
		}
		else{
			return ("No tienes acceso al sistema");
		}
	}

	public function index($course_name, $cursoid){

		$username = session()->get('nombre');

		return view('menu')
                        ->with('course_name', collect($course_name))
                        ->with('name_user', $username )
                        ->with('cursoid', collect($cursoid));
	}

	public function inscritos()
	{
		$username = session()->get('nombre');
                $c_id = session()->get('course_id');


		if($c_id == "" || $c_id == NULL){
                    $c_id = filter_input (INPUT_POST, 'course_id');
                    if($username == NULL || $c_id == "" || $c_id == NULL)
                        return $this->correoacurso();
                }

		if($c_id){
			$course_id = Course_overviews::whereid($c_id)->get()[0]->id;
			$course_name = Course_overviews::whereid($c_id)->get()[0]->display_name;
			session()->put('course_id', $course_id);
			session()->put('course_name', $course_name);
		}

		$super_user = session()->get('super_user');

		if(($super_user == "1") && (session()->get('course_id') == 0)){

			$inscritos = DB::table('vm_inscritos_x_curso')->leftJoin('course_name','vm_inscritos_x_curso.course_id','=','course_name.course_id')->select('vm_inscritos_x_curso.id','vm_inscritos_x_curso.course_name','vm_inscritos_x_curso.course_id','vm_inscritos_x_curso.inscritos','course_name.constancias')->orderBy('id')->paginate(10);
			$totalesi = DB::table('vm_inscritos_x_curso')->leftJoin('course_name','vm_inscritos_x_curso.course_id','=','course_name.course_id')->select('vm_inscritos_x_curso.id','vm_inscritos_x_curso.course_name','vm_inscritos_x_curso.course_id','vm_inscritos_x_curso.inscritos','course_name.constancias')->get();

                        $cn = "Puedes ver estadísticas de los siguientes cursos:";

			$fp = fopen ('download/totales.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'id';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'nombre del curso';
			$listaid[0][3] = 'inscritos';
                        $listaid[0][4] = 'constancias emitidas';
                        $listaid[0][5] = 'eficiencia';

			$i = 1;

			foreach ($totalesi  as $key => $value) {

				$listaid[$i][0] = ($value->id);
				$listaid[$i][1] = ($value->course_id);
				$listaid[$i][2] = ($value->course_name);
				$listaid[$i][3] = ($value->inscritos);
                                $listaid[$i][4] = ($value->constancias);
                                $listaid[$i][5]=  (round(($value->eficiencia=$value->constancias/($value->inscritos)*100),2));

				$i++;
			}

                        foreach ($inscritos as $key => $value) {

                        $value->eficiencia=$value->constancias/($value->inscritos)*100;

                        }

			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);


			return view('home')
			-> with('totalesi',($totalesi))
			-> with('inscritos',($inscritos))
			-> with('name_user', $username )
			-> with('course_name', $cn);

		}
		elseif( (session()->get('accescourse') > 0) || ($super_user == "1")) {
			$course_id = session()->get('course_id');
			$course_name = session()->get('course_name');

			$inscritos = DB::table('vm_inscritos_x_curso')
				->leftJoin('course_name','vm_inscritos_x_curso.course_id','=','course_name.course_id')
				->select('vm_inscritos_x_curso.id','vm_inscritos_x_curso.course_name','vm_inscritos_x_curso.course_id','vm_inscritos_x_curso.inscritos','course_name.constancias')
				->where('vm_inscritos_x_curso.course_id', '=', $course_id)
				->orderBy('id')
				->paginate(10);

      $totalesi = DB::table('vm_inscritos_x_curso')
				->leftJoin('course_name','vm_inscritos_x_curso.course_id','=','course_name.course_id')
				->select('vm_inscritos_x_curso.id','vm_inscritos_x_curso.course_name','vm_inscritos_x_curso.course_id','vm_inscritos_x_curso.inscritos','course_name.constancias')
				->where('vm_inscritos_x_curso.course_id', '=', $course_id)
				->get();

                        $fp = fopen ('download/totales.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'id';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'nombre del curso';
			$listaid[0][3] = 'inscritos';
                        $listaid[0][4] = 'constancias emitidas';
                        $listaid[0][5] = 'eficiencia';


			$i = 1;

			foreach ($totalesi as $key => $value) {

				$listaid[$i][0] = ($value->id);
				$listaid[$i][1] = ($value->course_id);
				$listaid[$i][2] = ($value->course_name);
				$listaid[$i][3] = ($value->inscritos);
                                $listaid[$i][4] = ($value->constancias);
                                $listaid[$i][5]=  (round(($value->eficiencia=$value->constancias/($value->inscritos)*100),2));

				$i++;
			}
                        foreach ($inscritos as $key => $value) {

                        $value->eficiencia=$value->constancias/($value->inscritos)*100;
                        }

			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);

			return view('home')
			-> with('inscritos',($inscritos))
			-> with('name_user', $username )
			-> with('totalesi', $totalesi)
			-> with('course_name', $course_name);
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

		if($username == NULL || $super_user == NULL)
			return $this->correoacurso();

		if($super_user == '1'){

			$activos = Course_overviews::where('end', '>=', DB::raw('curdate()'))->where('enrollment_start', '<=', DB::raw('curdate()'))->orderBy('end', 'desc')->paginate(10);
                        $totalesa = Course_overviews::where('end', '>=', DB::raw('curdate()'))->where('enrollment_start', '<=', DB::raw('curdate()'))->orderBy('end', 'desc')->get();

                        $cn = "Puedes ver estadísticas de los siguientes cursos:";

			$fp = fopen ('download/cursoa.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'nombre del curso';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'organizacion';
			$listaid[0][3] = 'fecha inicio';
			$listaid[0][4] = 'fecha fin';
			$listaid[0][5] = 'inicio de inscripcion';
			$listaid[0][6] = 'fin de inscripcion';
			$i = 1;
			foreach ($totalesa as $key => $value) {

				$listaid[$i][0] = ($value->display_name);
				$listaid[$i][1] = ($value->id);
				$listaid[$i][2] = ($value->display_org_with_default);
				$listaid[$i][3] = ($value->start);
				$listaid[$i][4] = ($value->end);
				$listaid[$i][5] = ($value->enrollment_start);
				$listaid[$i][6] = ($value->enrollment_end);
				$i++;
			}
                        foreach ($activos as $key => $value) {
                        }
			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);

			return view('cursoa')-> with ('totalesa',($totalesa))-> with ('activos',($activos))-> with('name_user', $username )-> with('course_name', $cn);
		}
		else
		return view('private')-> with('name_user', $username);
	}

	public function curson(){

		$super_user = session()->get('super_user');
		$username = session()->get('nombre');

		if($username == NULL || $super_user == NULL)
			return $this->correoacurso();

		if($super_user == '1'){

			$no_activos = Course_overviews::where(DB::raw('curdate()'), '<', 'start')->orderBy('enrollment_start', 'desc')->paginate(10);
                        $totalesna = Course_overviews::where(DB::raw('curdate()'), '<', 'start')->orderBy('enrollment_start', 'desc')->get();

			$cn = "Puedes ver estadísticas de los siguientes cursos:";

			$fp = fopen ('download/no_activos.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'nombre del curso';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'organizacion';
			$listaid[0][3] = 'fecha inicio';
			$listaid[0][4] = 'fecha fin';
			$listaid[0][5] = 'inicio de inscripcion';
			$listaid[0][6] = 'fin de inscripcion';
			$i = 1;
			foreach ($totalesna  as $key => $value) {

				$listaid[$i][0] = ($value->display_name);
				$listaid[$i][1] = ($value->id);
				$listaid[$i][2] = ($value->display_org_with_default);
				$listaid[$i][3] = ($value->start);
				$listaid[$i][4] = ($value->end);
				$listaid[$i][5] = ($value->enrollment_start);
				$listaid[$i][6] = ($value->enrollment_end);
				$i++;
			}
                        foreach ($no_activos as $key => $value) {
                        }
			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);

			return view('curson') -> with ('totalesna', ($totalesna))-> with ('no_activos', ($no_activos))-> with('name_user', $username )-> with('course_name', $cn);

		}
		else
		return view('private')-> with('name_user', $username);
	}

	public function cursoc(){

		$super_user = session()->get('super_user');
		$username = session()->get('nombre');

		if($username == NULL || $super_user == NULL)
			return $this->correoacurso();

		if($super_user == '1'){

			$concluido = Course_overviews::where('end', '<', DB::raw('now()'))->orderBy('end', 'desc')->paginate(10);
                        $totalesc = Course_overviews::where('end', '<', DB::raw('now()'))->orderBy('end', 'desc')->get();
			$cn = "Puedes ver estadísticas de los siguientes cursos:";

			$fp = fopen ('download/cursoc.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'nombre del curso';
			$listaid[0][1] = 'id curso';
			$listaid[0][2] = 'organizacion';
			$listaid[0][3] = 'fecha inicio';
			$listaid[0][4] = 'fecha fin';
			$listaid[0][5] = 'inicio de inscripcion';
			$listaid[0][6] = 'fin de inscripcion';
			$i = 1;
			foreach ($totalesc  as $key => $value) {

				$listaid[$i][0] = ($value->display_name);
				$listaid[$i][1] = ($value->id);
				$listaid[$i][2] = ($value->display_org_with_default);
				$listaid[$i][3] = ($value->start);
				$listaid[$i][4] = ($value->end);
				$listaid[$i][5] = ($value->enrollment_start);
				$listaid[$i][6] = ($value->enrollment_end);

				$i++;
			}
                        foreach ($concluido as $key => $value) {
                        }
			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}
      			fclose($fp);
			return view('cursoc')-> with ('totalesc',($concluido))-> with ('concluido',($concluido))-> with('name_user', $username )-> with('course_name', $cn);
		}
		else
		return view('private')-> with('name_user', $username);
	}

	public function totales(){

		$username = session()->get('nombre');
		$super_user = session()->get('super_user');

		if($username == NULL || $super_user == NULL)
			return $this->correoacurso();

		if(($super_user == '1') && (session()->get('course_id') == null)){

			$perfil_p = DB::select(DB::raw('SELECT count(p.sinco_1) c, s.descripcion d FROM mexicox.auth_perfilusuario p
			inner join mexicox.auth_sinco s on p.sinco_1 = s.clave
			group by p.sinco_1 order by count(p.sinco_1) desc'));

			$fp = fopen('download/perfilp.csv', 'w');

			$titulop = array('Usuarios', 'Descripcion');
			fputcsv($fp, $titulop);

			foreach ($perfil_p as $key) {
				$array = array($key->c , $key->d);
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
                        $d = DB::table('edxapp.auth_user')->whereis_active('0')->count('id');

			$info = array($t, $n, $a,$d);

			$fp = fopen ('download/totales.csv', 'w');

			$info1 = array('Usuarios', 'Cantidad');
			fputcsv($fp, $info1);

			$info1 = array('Registrados en MéxicoX' ,$info[0]);
			fputcsv($fp, $info1);

			$info1 = array('Usuarios con cuenta activada en MéxicoX' ,$info[1] );
			fputcsv($fp, $info1);

			$info1 = array('Usuarios que no tienen su cuenta activada en MéxicoX', $info[2]);
			fputcsv($fp, $info1);

                        $info1 = array('Usuarios desinscritos en MéxicoX', $info[3]);
			fputcsv($fp, $info1);
			fclose($fp);

			$cn ="MéxicoX";
			$cn0 = "Registrados en MéxicoX";
			$cn1 = "Usuarios con cuenta activada en MéxicoX";
			$cn2 = "Usuarios que no tienen su cuenta activada en MéxicoX";
      $cn3 = "Usuarios que se desinscribieron";

			return view('usuarios/totales')
			-> with ('info', collect($info))
			-> with ('edad', collect($edad))
			-> with('infot', collect($infot))
			-> with ('estudio', collect($estudio))
			-> with('name_user', $username )
			-> with('course_name0', $cn0)
			-> with('course_name1', $cn1)
			-> with('course_name2', $cn2)
                        -> with('course_name3', $cn3)
			-> with('course_name', $cn)
			-> with('perfil_p', collect($perfil_p));

		}

		elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

			$course_id = session()->get('course_id');

			if(!$course_id)
			{
				return $this->correoacurso();
			}

			$perfil_p = DB::select(DB::raw('SELECT count(p.sinco_1) c, s.descripcion d
				FROM mexicox.auth_perfilusuario p
				inner join mexicox.auth_sinco s on p.sinco_1 = s.clave
				left join edxapp.student_courseenrollment c on c.user_id = p.user_id
				where c.course_id = "'.$course_id.'" group by p.sinco_1 order by c desc'));


		 $fp = fopen('download/perfilp.csv', 'w');

		 $titulop = array('Usuarios', 'Descripcion');
		 fputcsv($fp, $titulop);

		 foreach ($perfil_p as $key) {
			 $array = array($key->c , $key->d);
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
                        $desinscritos = DB::table('edxapp.student_courseenrollment')->wherecourse_id($course_id)->whereis_active('0')->count('id');

                        $n = $t-$inscritos;
                        $d=$inscritos-$desinscritos;

			$info = array($t, $n, $inscritos, $desinscritos);
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

                        $info1 = array('Desinscritos en '. $course_name, $info[3]);
			$c_name3 = "Desinscritos en ".$course_name;
			fputcsv($fp, $info1);
			fclose($fp);

			return view('usuarios/totales')
			-> with ('info', collect($info))
			-> with ('edad', collect($edad))
			-> with ('infot', collect($infot))
			-> with ('estudio', collect($estudio))
			-> with('name_user', $username )
			-> with('course_name', $course_name)
			-> with('course_name0', $c_name0)
			-> with('course_name1', $c_name1)
			-> with('course_name2', $c_name2)
                        -> with('course_name3', $c_name3)
			-> with('perfil_p', collect($perfil_p));

		}
		else
			return view('accescourse')-> with('name_user', $username);
	}

	public function infocurso(){

		$super_user = session()->get('super_user');
		$course_name = session()->get('course_name');
		$course_id = session()->get('course_id');
		$username = session()->get('nombre');

		if($username == NULL || $super_user == NULL)
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

			$activities_course = DB::select(DB::raw('select count(distinct(module_id)) from edxapp.courseware_studentmodule where course_id = "'.$course_id.'"'));
			$users_complete_activities = DB::select(DB::raw('select count(distinct(module_id)) c from edxapp.courseware_studentmodule where course_id = "'.$course_id.'" group by student_id order by count(distinct(module_id))'));

			$activities_activities = array();
			$activities_users = array();

			$activities_activities[0] = "Numero de actividades";
			$activities_users[0] = "Numero de alumnos que las completaron";

			$last = 0;
			$n = 0;
			$m = 0;
			$k = 1;

			$sizearray = count($users_complete_activities);

			$fusers_complete_activities = fopen ('download/complete_activities.csv', 'w');
			$act = array('Actividades', 'Usuarios');

			fputcsv($fusers_complete_activities, $act);

			foreach ($users_complete_activities as $key) {

				if($last == 0 ){

					$last = $key->c;
					$n++;
					$m++;
				}
				else if ($last == $key->c) {

					$n++;
					$m++;
				}
				else if($last != $key->c) {

					$activities_activities[$k] = $last;
					$activities_users[$k] = $n;
					$act = array($last, $n);
					fputcsv($fusers_complete_activities, $act);
					$n = 1;
					$m++;
					$k++;
					$last = $key->c;

					if($m == $sizearray){
						$activities_activities[$k] = $last;
						$activities_users[$k] = $n;

					}
				}
			}
			fclose($fusers_complete_activities);

			return view('usuarios/infocurso')
			-> with('desercion', $json)
			-> with('name_user', $username )
			-> with('course_name', $course_name)
			-> with('semanal', collect($sem1))
			-> with('s', $s)
			-> with('f', $f)
			-> with('l', $l)
			-> with('activities_course', $activities_course)
			-> with('activities_activities', collect($activities_activities))
			-> with('activities_users', collect($activities_users));
		}
		else{

			$username = session()->get('nombre');
			return view('accescourse')-> with('name_user', $username);
		}
	}

	public function inscritost(){

		$username = session()->get('nombre');
		$course_id = session()->get('course_id');
		$super_user = session()->get('super_user');

		if($username == NULL || $super_user == NULL)
			return $this->correoacurso();
		else{
		if(($super_user == '1')){

			$mes = DB::select(DB::raw('SELECT MONTH(date_joined) as month, YEAR(date_joined) as year, count(id) as c FROM edxapp.auth_user where is_active = "1" GROUP BY YEAR(date_joined), MONTH(date_joined)'));

			$cur = DB::select(DB::raw('SELECT MONTH(created) as month, YEAR(created) as year, count(id) as c FROM edxapp.student_courseenrollment where is_active = "1" group by YEAR(created), MONTH(created)'));

/////////////////////////////////////////////////

			$ins = fopen ('download/inscritos.csv', 'w');

			$registros1 = array ('Año', 'Mes', 'Registrados');
			fputcsv($ins, $registros1);

			foreach ($mes as $u){

				$registros1 = array ($u->year, $u->month, $u->c);
				fputcsv($ins, $registros1);
			}

			fclose($ins);

/////////////////////////////////////7
			$reg = fopen ('download/registrados.csv', 'w');

			$registros2 =  array ('Año', 'Mes', 'Registrados');
			fputcsv($reg, $registros2);

			foreach ($cur as $u){

				$registros2 = array ($u->year, $u->month, $u->c);
				fputcsv($reg, $registros2);
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

			$n_instructores = DB::select(DB::raw('SELECT count(*) as n FROM edxapp.student_courseaccessrole where role = "instructor"'))[0]->n;

			$cn ="MéxicoX";

			return view('usuarios/inscritost')
			-> with('mes', collect($mes))
			-> with('cur', collect($cur))
			-> with('name_user', $username)
			-> with('users_course', collect($users_course))
			-> with('course_name', $cn)
			-> with('n_instructores', $n_instructores);

		}else
		return view('private')-> with('name_user', $username);
	}
}



	public function geo(){

		$super_user = session()->get('super_user');
		$course_name = session()->get('course_name');
		$course_id = session()->get('course_id');
		$username = session()->get('nombre');

		if($username == NULL || $super_user == NULL)
			return $this->correoacurso();

		if(($super_user == '1') && (session()->get('course_name') == null))
		{
			$country = DB::select(DB::raw('SELECT country, count(country) as cc from edxapp.auth_userprofile group by country order by cc desc'));

			$state = DB::select(DB::raw('SELECT c.Estado as state, count(c.Estado) as cs from edxapp.auth_userprofile a
								inner join mexicox.codigospostales c on c.CodigoPostal = a.user_id group by c.Estado order by cs desc'));

			$usuarios_pais = fopen ('download/usuarios_pais.csv', 'w');
			$usuarios_estado = fopen ('download/usuarios_estado.csv', 'w');

			foreach ($country as $pais => $valor) {
				fputcsv($usuarios_pais, [$valor->country, $valor->cc]);
			}

			foreach ($state as $estado => $val) {
				fputcsv($usuarios_estado, [$val->state, $val->cs]);
			}

			fclose($usuarios_pais);
			fclose($usuarios_estado);


			$cn = "MéxicoX";

			return view('usuarios/geo')
			->with('country', collect($country))
			->with('state', collect($state))
			->with('name_user', $username )
			->with('course_name', $cn);

		}elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

			$country = DB::select(DB::raw('SELECT a.country, count(a.country) as cc from edxapp.auth_userprofile a
								inner join edxapp.student_courseenrollment s on a.user_id = s.user_id
								where s.course_id = "'.$course_id.'" group by a.country order by cc desc'));

			$state = DB::select(DB::raw('SELECT c.Estado as state, count(c.Estado) as cs from edxapp.auth_userprofile a
								inner join mexicox.codigospostales c on c.CodigoPostal = a.user_id
								inner join edxapp.student_courseenrollment s on a.user_id = s.user_id
								where s.course_id = "'.$course_id.'" group by c.Estado order by cs desc'));


			$usuarios_pais = fopen ('download/usuarios_pais.csv', 'w');
			$usuarios_estado = fopen ('download/usuarios_estado.csv', 'w');

			foreach ($country as $pais => $valor) {
				fputcsv($usuarios_pais, [$valor->country, $valor->cc]);
			}

			foreach ($state as $estado => $val) {
				fputcsv($usuarios_estado, [$val->state, $val->cs]);
			}

			fclose($usuarios_pais);
			fclose($usuarios_estado);


			return view('usuarios/geo')
			-> with('country', collect($country))
			-> with('state', collect($state))
			-> with('name_user', $username )
			-> with('course_name', $course_name);

		}
		else
			return view('accescourse')-> with('name_user', $username);

	}

	public function videos(){

		$super_user = session()->get('super_user');
		$course_name = session()->get('course_name');
		$course_id = session()->get('course_id');
		$username = session()->get('nombre');

		if($username == NULL || $super_user == NULL)
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
	public function other_course(){

		session()->put('course_name', NULL);
		session()->put('course_id', NULL);

		return $this->correoacurso();


	}
    
    
/*  **********   Reporte de evaluación por pares    **********   */
    public function EvalPares(){
		$correo = \Auth::user() -> email;

		if(empty($name = DB::table('edxapp.auth_user')->whereemail($correo)->get())){
			return view('no_asociado_curso');
		}

		$username = $name[0]->username;
		session()->put('nombre', $username);

		if($name[0]->is_superuser == 1)
		{
			session()->put('super_user', '1');
            $course_name = DB::table('edxapp.workflow_assessmentworkflow AS A')
                ->join('edxapp.course_overviews_courseoverview AS B', 'A.course_id', '=', 'B.id')
                ->groupBy('A.item_id')
                ->orderBy('display_name')
                ->select('A.id', 'B.display_name', 'A.course_id', 'A.item_id')->get();
			return $this->muestraEvalPares($course_name);
		}
		else if($name[0]->is_active == true)
		{
			$id = DB::table('edxapp.auth_user')->whereemail($correo)->whereis_active('1')->get()[0]->id;

			if( sizeof(DB::table('edxapp.student_courseaccessrole')
                ->whereuser_id($id)
                ->whererole("instructor")
                ->where('course_id', 'like', 'course%')->get()) > 1 ){
					$course_id = DB::table('edxapp.student_courseaccessrole')
                        ->whereuser_id($id)
                        ->whererole("instructor")
                        ->where('course_id', 'like', 'course%')
                        ->get();
            }else {
				$course_id = DB::table('edxapp.student_courseaccessrole')
                    ->whereuser_id($id)
                    ->whererole("instructor")
                    ->get();
            }

			$n = sizeof($course_id);

			session()->put('accescourse', $n);
			session()->put('super_user', '0');

			if($n < 1){
				return view('accescourse')-> with('name_user', $username);
			}
			else{
				session()->put('courses_names', $course_name);
				return $this->muestraEvalPares($course_name);
			}
		}
		else{
			return ("No tienes acceso al sistema");
		}
    }
    
    public function muestraEvalPares($course_name){
        $username = session()->get('nombre');

		return view('cursoEvalPares')
                        ->with('course_name', $course_name)
                        ->with('name_user', $username );
    }
    
	public function muestraReporteEP(){
        $item_id = session()->get('item_id');
        if($item_id){
            $c_id = session()->get('c_id');
        }
        else{
            $variable = filter_input (INPUT_POST, 'course_id');
            $arregloVar = explode("#",$variable);
            $item_id = $arregloVar[0];
            session()->put('item_id', $item_id);
            $c_id = $arregloVar[1];
            session()->put('c_id', $c_id);
        }
        
		$username = session()->get('nombre');
        
        if($username == NULL || $c_id == "" || $c_id == NULL)
            return $this->correoacurso();

		if($c_id){
			$course_id = Course_overviews::whereid($c_id)->get()[0]->id;
			$course_name = Course_overviews::whereid($c_id)->get()[0]->display_name;
			session()->put('course_id', $course_id);
			session()->put('course_name', $course_name);
		}

		//$super_user = session()->get('super_user');

		//if($super_user == "1"){
			$course_id = session()->get('course_id');
			$course_name = session()->get('course_name');

			$consultaPagina = DB::table('edxapp.workflow_assessmentworkflow AS A')
				->leftJoin('edxapp.submissions_submission AS B','A.submission_uuid','=','B.uuid')
                ->leftJoin('edxapp.submissions_score AS C','A.submission_uuid','=','C.submission_id')
                ->leftJoin('edxapp.assessment_assessment AS D','D.submission_uuid','=','B.uuid')
                ->leftJoin('edxapp.assessment_assessmentfeedback AS E','E.submission_uuid','=','B.uuid')
				->select('A.status', 'B.attempt_number', 'B.raw_answer', 'B.student_item_id', 'C.points_earned', 'C.points_possible', 'D.feedback', 'E.feedback_text')
				->where('A.item_id', '=', $item_id)
				->paginate(10);
                
            $consultaArchivo = DB::table('edxapp.workflow_assessmentworkflow AS A')
				->leftJoin('edxapp.submissions_submission AS B','A.submission_uuid','=','B.uuid')
                ->leftJoin('edxapp.submissions_score AS C','A.submission_uuid','=','C.submission_id')
                ->leftJoin('edxapp.assessment_assessment AS D','D.submission_uuid','=','B.uuid')
                ->leftJoin('edxapp.assessment_assessmentfeedback AS E','E.submission_uuid','=','B.uuid')
				->select('A.status', 'B.attempt_number', 'B.raw_answer', 'B.student_item_id', 'C.points_earned', 'C.points_possible', 'D.feedback', 'E.feedback_text')
				->where('A.item_id', '=', $item_id)
				->get();

            $fp = fopen ('download/totales.csv', 'w');
			$listaid = array();
			$listaid[0][0] = 'status';
			$listaid[0][1] = 'attempt_number';
			$listaid[0][2] = 'raw_answer';
			$listaid[0][3] = 'student_item_id';
            $listaid[0][4] = 'points_earned';
            $listaid[0][5] = 'points_possible';
            $listaid[0][6] = 'feedback';
            $listaid[0][7] = 'feedback_text';
			$i = 1;

			foreach ($consultaArchivo as $key => $value) {
				$listaid[$i][0] = ($value->status);
				$listaid[$i][1] = ($value->attempt_number);
				$listaid[$i][2] = ($value->raw_answer);
				$listaid[$i][3] = ($value->student_item_id);
                $listaid[$i][4] = ($value->points_earned);
                $listaid[$i][5]=  ($value->points_possible);
                $listaid[$i][6]=  ($value->feedback);
                $listaid[$i][7]=  ($value->feedback_text);
                
				$i++;
			}
            /*foreach ($inscritos as $key => $value) {
                $value->eficiencia=$value->constancias/($value->inscritos)*100;
            }*/

			foreach ($listaid as $value) {
				fputcsv($fp, $value );
			}

			fclose($fp);

			return view('reporteEvalPares')
			-> with('consulta1EP',($consultaPagina))
			-> with('name_user', $username )
			-> with('course_name', $course_name);
		/*}
		else
			return view('accescourse')-> with('name_user', $username);*/
    }
}
