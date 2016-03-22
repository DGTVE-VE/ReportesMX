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

        if(empty($name = DB::table('auth_user')->whereemail($correo)->get())){
            return ("Tu correo no esta asociado a algun curso en la plataforma");
        }

            $username = $name[0]->username;
            session()->put('nombre', $username);

        if($name[0]->is_superuser == 1)
        {
            session()->put('super_user', '1');
            $id = DB::table('auth_user')->whereemail($correo)->whereis_superuser('1')->get()[0]->id;

            $course_name = DB::table('course_name')->whereBetween('fin',array(20160000, 20990000))->whereBetween('inicio',array(20160000, date("Ymd")))->lists('course_name');
            return $this->index($course_name);
        }

        else if($name[0]->is_active == true)
        {

            $id = DB::table('auth_user')->whereemail($correo)->whereis_active('1')->get()[0]->id;
            $course_id = DB::table('student_courseaccessrole')->whereuser_id($id)->whererole("instructor")->get();

            $n = sizeof($course_id);

            session()->put('accescourse', $n);
            session()->put('super_user', '0');

            for($i = 0, $j=0; $i < $n ; $i++, $j++)
            {
                $cursoid[$j] = $course_id[$i]->course_id;
                $course_name[$j] = DB::table('course_name')->wherecourse_id($cursoid[$j])->get()[0]->course_name;
            }
            if($n < 1){
                return view('accescourse');

            }
            else{
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

        if($course_name){

            $course_id = DB::table('course_name')->wherecourse_name($course_name)->get()[0]->course_id;
            session()->put('course_id', $course_id);
            session()->put('course_name', $course_name);
        }

        $super_user = session()->get('super_user');

        if(($super_user == "1") && (session()->get('course_name') == 0)){



          	$inscritos = DB::table('vm_inscritos_x_curso')->get();

						$cn = "Puedes ver estadísticas de los siguientes cursos:";

        return view('home')->with ('inscritos', collect($inscritos)) -> with('name_user', $username )-> with('course_name', $cn);

        }
        elseif( (session()->get('accescourse') > 0) || ($super_user == "1")) {
            $course_id = session()->get('course_id');
						$course_name = session()->get('course_name');

            $inscritos = DB::table('vm_inscritos_x_curso')->wherecourse_id($course_id)->get();

        return view('home')->with ('inscritos', collect($inscritos))-> with('name_user', $username )-> with('course_name', $course_name);
        }
        else
             return view('accescourse');


	}

    public function cursos(){

            UseController::cursoa();
            UseController::curson();
            UseController::cursoc();

    }

    public function cursoa(){

        $super_user = session()->get('super_user');

        if($super_user == '1'){

            $activos = DB::select(DB::raw('SELECT * FROM course_name WHERE CURDATE() <= fin AND CURDATE() >= inicio'));

						$cn = "Puedes ver estadísticas de los siguientes cursos:";
						$username = session()->get('nombre');

            return view('cursoa') -> with ('activos', collect($activos))-> with('name_user', $username )-> with('course_name', $cn);
        }
        else
            return view('private');
    }

    public function curson(){

        $super_user = session()->get('super_user');

        if($super_user == '1'){

        $no_activos = DB::select(DB::raw('SELECT * FROM course_name WHERE CURDATE() < inicio'));

				$cn = "Puedes ver estadísticas de los siguientes cursos:";
				$username = session()->get('nombre');

        return view('curson') -> with ('no_activos', collect($no_activos))-> with('name_user', $username )-> with('course_name', $cn);

        }

        else
            return view('private');
    }

    public function cursoc(){

        $super_user = session()->get('super_user');

        if($super_user == '1'){


        $concluido = DB::select(DB::raw('SELECT * FROM course_name WHERE CURDATE() > fin'));

				$cn = "Puedes ver estadísticas de los siguientes cursos:";
				$username = session()->get('nombre');

        return view('cursoc') -> with ('concluido', collect($concluido))-> with('name_user', $username )-> with('course_name', $cn);

             }

        else
            return view('private');
    }

    public function totales(){

        $username = session()->get('nombre');
        $super_user = session()->get('super_user');

        $t = DB::table('auth_user')->count('id');

        if(($super_user == '1') && (session()->get('course_id') == null)){

        $n = DB::table('auth_user')->whereis_active('0')->count('id');
        $a = DB::table('auth_user')->whereis_active('1')->count('id');

        $info = array($t, $n, $a);

				$cn = "Puedes ver estadísticas de los siguientes cursos:";

        return view('usuarios/totales') -> with ('info', collect($info))-> with('name_user', $username )-> with('course_name', $cn);

        }elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

            $course_id = session()->get('course_id');



						if(!$course_id)
						{
							return $this->correoacurso();
						}
						$inscritos = DB::table('vm_inscritos_x_curso')->wherecourse_id($course_id)->get()[0]->inscritos;

            $n = $t-$inscritos;

            $info = array($t, $n, $inscritos);
						$course_name = session()->get('course_name');

            return view('usuarios/totales') -> with ('info', collect($info))->with('name_user', $username )-> with('course_name', $course_name);

        }else
            return view('accescourse');
	}

    public function genero()
    {

        $username = session()->get('nombre');
        $super_user = session()->get('super_user');
        $course_name = session()->get('course_name');
        $course_id = session()->get('course_id');

        if(($super_user == '1') && (session()->get('course_name') == null))
        {

            $f = DB::table('auth_userprofile')->wheregender("f")->count();
            $m = DB::table('auth_userprofile')->wheregender("m")->count();
            $n = DB::table('auth_userprofile')->wheregender("")->count();

            $infot = array($f, $m, $n);

						$cn = "Puedes ver estadísticas de los siguientes cursos:";

            return view('usuarios/genero') -> with ('infot', collect($infot))-> with('name_user', $username )-> with('course_name', $cn);

        }elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

            $m = DB::table('student_courseenrollment')->join('auth_userprofile', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wheregender('m')->count();
            $f = DB::table('student_courseenrollment')->join('auth_userprofile', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wheregender('f')->count();
            $n = DB::table('student_courseenrollment')->join('auth_userprofile', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wheregender('')->count();

            $infot = array($f, $m, $n);

						$course_name = session()->get('course_name');

            return view('usuarios/genero') -> with ('infot', collect($infot))->with('name_user', $username )-> with('course_name', $course_name);

        }else
            return view('accescourse');
	}

    public function edad(){

        $super_user = session()->get('super_user');
        $course_name = session()->get('course_name');
        $course_id = session()->get('course_id');
        $username = session()->get('nombre');

        if(($super_user == '1') && (session()->get('course_name') == null))
        {
         $date = date("Y");

        $edad15 = DB::table('auth_userprofile')->where('year_of_birth', '>=', $date - '15')->count('id');
        $edad15_20 = DB::table('auth_userprofile')->where('year_of_birth', '<', $date - '15')->where('year_of_birth', '>=', $date - '20')->count('id');
        $edad20_25 = DB::table('auth_userprofile')->where('year_of_birth', '<', $date - '20')->where('year_of_birth', '>=', $date - '25')->count('id');
        $edad25_30 = DB::table('auth_userprofile')->where('year_of_birth', '<', $date - '25')->where('year_of_birth', '>=', $date - '30')->count('id');
        $edad30_35 = DB::table('auth_userprofile')->where('year_of_birth', '<', $date - '30')->where('year_of_birth', '>=', $date - '35')->count('id');
        $edad35_40 = DB::table('auth_userprofile')->where('year_of_birth', '<', $date - '35')->where('year_of_birth', '>=', $date - '40')->count('id');
        $edad40_45 = DB::table('auth_userprofile')->where('year_of_birth', '<', $date - '40')->where('year_of_birth', '>=', $date - '45')->count('id');
        $edad45_50 = DB::table('auth_userprofile')->where('year_of_birth', '<', $date - '45')->where('year_of_birth', '>=', $date - '50')->count('id');
        $edad50 = DB::table('auth_userprofile')->where('year_of_birth', '<', $date - '50')->count('id');

        $edad = array($edad15,$edad15_20,$edad20_25,$edad25_30,$edad30_35,$edad35_40,$edad40_45,$edad45_50,$edad50);

				$cn = "Puedes ver estadísticas de los siguientes cursos:";

        return view('usuarios/edades') -> with ('edad', collect($edad))-> with('name_user', $username )-> with('course_name', $cn);

        }elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

						$date = date("Y");

	         $edad15 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '>=', $date - '15')->select('id')->count();
	         $edad15_20 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '15')->where('year_of_birth', '>=', $date - '20')->select('id')->count();
	         $edad20_25 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '20')->where('year_of_birth', '>=', $date - '25')->select('id')->count();
	         $edad25_30 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '25')->where('year_of_birth', '>=', $date - '30')->select('id')->count();
	         $edad30_35 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '30')->where('year_of_birth', '>=', $date - '35')->select('id')->count();
	         $edad35_40 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '35')->where('year_of_birth', '>=', $date - '40')->select('id')->count();
	         $edad40_45 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '40')->where('year_of_birth', '>=', $date - '45')->select('id')->count();
	         $edad45_50 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '45')->where('year_of_birth', '>=', $date - '50')->select('id')->count();
	         $edad50 = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->where('year_of_birth', '<', $date - '50')->select('id')->count();

	         $edad = array($edad15,$edad15_20,$edad20_25,$edad25_30,$edad30_35,$edad35_40,$edad40_45,$edad45_50,$edad50);

					 $course_name = session()->get('course_name');

	         return view('usuarios/edades') -> with ('edad', collect($edad))->with('name_user', $username )-> with('course_name', $course_name);

        }else
            return view('accescourse');

	}

    public function nivel(){

			$super_user = session()->get('super_user');
			$course_name = session()->get('course_name');
			$course_id = session()->get('course_id');

			$username = session()->get('nombre');

				if(($super_user == '1') && (session()->get('course_name') == null))
        {

				$d = DB::table('auth_userprofile')->wherelevel_of_education('p')->select('id')->count();
				$m = DB::table('auth_userprofile')->wherelevel_of_education('m')->select('id')->count();
				$t = DB::table('auth_userprofile')->wherelevel_of_education('a')->select('id')->count();
				$l = DB::table('auth_userprofile')->wherelevel_of_education('b')->select('id')->count();
				$p = DB::table('auth_userprofile')->wherelevel_of_education('hs')->select('id')->count();
				$s = DB::table('auth_userprofile')->wherelevel_of_education('jhs')->select('id')->count();
				$pr = DB::table('auth_userprofile')->wherelevel_of_education('el')->select('id')->count();
				$n = DB::table('auth_userprofile')->wherelevel_of_education('none')->select('id')->count();
				$o = DB::table('auth_userprofile')->wherelevel_of_education('other')->select('id')->count();
				$ne = DB::table('auth_userprofile')->wherelevel_of_education('')->select('id')->count();
				$dc = DB::table('auth_userprofile')->wherelevel_of_education('p_se')->select('id')->count();
				$do = DB::table('auth_userprofile')->wherelevel_of_education('p_oth')->select('id')->count();
				$na = DB::table('auth_userprofile')->wherelevel_of_education('NULL')->select('id')->count();

        $estudio = array($d, $m, $t, $l, $p, $s, $pr, $n, $o, $ne, $dc, $do, $na);

				$cn = "Puedes ver estadísticas de los siguientes cursos:";

        return view('usuarios/nivel') -> with ('estudio', collect($estudio))-> with('name_user', $username )-> with('course_name', $cn);

			}elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

					$d = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('p')->select('id')->count();
					$m = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('m')->select('id')->count();
					$t = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('a')->select('id')->count();
					$l = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('b')->select('id')->count();
					$p = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('hs')->select('id')->count();
					$s = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('jhs')->select('id')->count();
					$pr = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('el')->select('id')->count();
					$n = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('none')->select('id')->count();
					$o = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('other')->select('id')->count();
					$ne = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('')->select('id')->count();
					$dc = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('p_se')->select('id')->count();
					$do = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('p_oth')->select('id')->count();
					$na = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherelevel_of_education('NULL')->select('id')->count();

					$estudio = array($d, $m, $t, $l, $p, $s, $pr, $n, $o, $ne, $dc, $do, $na);

					$course_name = session()->get('course_name');

					return view('usuarios/nivel') -> with ('estudio', collect($estudio))->with('name_user', $username )-> with('course_name', $course_name);

			}else

					return view('accescourse');

	}

    public function geo(){

			$super_user = session()->get('super_user');
			$course_name = session()->get('course_name');
			$course_id = session()->get('course_id');
			$username = session()->get('nombre');


				if(($super_user == '1') && (session()->get('course_name') == null))
				{

				$AG = DB::table('auth_userprofile')->wherecountry('AG')->select('id')->count();
				$BC = DB::table('auth_userprofile')->wherecountry('BC')->select('id')->count();
				$BS = DB::table('auth_userprofile')->wherecountry('BS')->select('id')->count();
				$CC = DB::table('auth_userprofile')->wherecountry('CC')->select('id')->count();
				$CS = DB::table('auth_userprofile')->wherecountry('CS')->select('id')->count();
				$CH = DB::table('auth_userprofile')->wherecountry('CH')->select('id')->count();
				$CL = DB::table('auth_userprofile')->wherecountry('CL')->select('id')->count();
				$CM = DB::table('auth_userprofile')->wherecountry('CM')->select('id')->count();
				$DF = DB::table('auth_userprofile')->wherecountry('DF')->select('id')->count();
				$DG = DB::table('auth_userprofile')->wherecountry('DG')->select('id')->count();
				$GT = DB::table('auth_userprofile')->wherecountry('GT')->select('id')->count();
				$GR = DB::table('auth_userprofile')->wherecountry('GR')->select('id')->count();
				$HG = DB::table('auth_userprofile')->wherecountry('HG')->select('id')->count();
				$JC = DB::table('auth_userprofile')->wherecountry('JC')->select('id')->count();
				$MC = DB::table('auth_userprofile')->wherecountry('MC')->select('id')->count();
				$MN = DB::table('auth_userprofile')->wherecountry('MN')->select('id')->count();
				$MS = DB::table('auth_userprofile')->wherecountry('MS')->select('id')->count();
				$NT = DB::table('auth_userprofile')->wherecountry('NT')->select('id')->count();
				$NL = DB::table('auth_userprofile')->wherecountry('NL')->select('id')->count();
				$OC = DB::table('auth_userprofile')->wherecountry('OC')->select('id')->count();
				$PL = DB::table('auth_userprofile')->wherecountry('PL')->select('id')->count();
				$QT = DB::table('auth_userprofile')->wherecountry('QT')->select('id')->count();
				$QR = DB::table('auth_userprofile')->wherecountry('QR')->select('id')->count();
				$SP = DB::table('auth_userprofile')->wherecountry('SP')->select('id')->count();
				$SL = DB::table('auth_userprofile')->wherecountry('SL')->select('id')->count();
				$SR = DB::table('auth_userprofile')->wherecountry('SR')->select('id')->count();
				$TC = DB::table('auth_userprofile')->wherecountry('TC')->select('id')->count();
				$TS = DB::table('auth_userprofile')->wherecountry('TS')->select('id')->count();
				$TL = DB::table('auth_userprofile')->wherecountry('TL')->select('id')->count();
				$VZ = DB::table('auth_userprofile')->wherecountry('VZ')->select('id')->count();
				$YN = DB::table('auth_userprofile')->wherecountry('YN')->select('id')->count();
				$ZS = DB::table('auth_userprofile')->wherecountry('ZS')->select('id')->count();
				$EX = DB::table('auth_userprofile')->wherecountry('EX')->select('id')->count();

        $total = $AG + $BC + $BS + $CC + $CS + $CH + $CL + $CM + $DF + $DG + $GT + $GR + $HG + $JC + $MC + $MN + $MS + $NT + $NL + $OC + $PL + $QT + $QR + $SP + $SL + $SR + $TC + $TS + $TL + $VZ + $YN + $ZS + $EX;

        $geo = array($AG, $BC, $BS, $CC, $CS, $CH, $CL, $CM, $DF, $DG, $GT, $GR, $HG, $JC, $MC, $MN, $MS, $NT, $NL, $OC, $PL, $QT, $QR, $SP, $SL, $SR, $TC, $TS, $TL, $VZ, $YN, $ZS, $EX, $total);

				$cn = "Puedes ver estadísticas de los siguientes cursos:";

        return view('usuarios/geo') -> with('geo', collect($geo))-> with('name_user', $username )-> with('course_name', $cn);

			}elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

			$AG = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('AG')->select('id')->count();
			$BC = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('BC')->select('id')->count();
			$BS = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('BS')->select('id')->count();
			$CC = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CC')->select('id')->count();
			$CS = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CS')->select('id')->count();
			$CH = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CH')->select('id')->count();
			$CL = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CL')->select('id')->count();
			$CM = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('CM')->select('id')->count();
			$DF = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('DF')->select('id')->count();
			$DG = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('DG')->select('id')->count();
			$GT = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('GT')->select('id')->count();
			$GR = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('GR')->select('id')->count();
			$HG = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('HG')->select('id')->count();
			$JC = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('JC')->select('id')->count();
			$MC = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('MC')->select('id')->count();
			$MN = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('MN')->select('id')->count();
			$MS = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('MS')->select('id')->count();
			$NT = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('NT')->select('id')->count();
			$NL = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('NL')->select('id')->count();
			$OC = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('OC')->select('id')->count();
			$PL = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('PL')->select('id')->count();
			$QT = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('QT')->select('id')->count();
			$QR = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('QR')->select('id')->count();
			$SP = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('SP')->select('id')->count();
			$SL = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('SL')->select('id')->count();
			$SR = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('SR')->select('id')->count();
			$TC = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('TC')->select('id')->count();
			$TS = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('TS')->select('id')->count();
			$TL = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('TL')->select('id')->count();
			$VZ = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('VZ')->select('id')->count();
			$YN = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('YN')->select('id')->count();
			$ZS = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('ZS')->select('id')->count();
			$EX = DB::table('auth_userprofile')->join('student_courseenrollment', 'student_courseenrollment.user_id', '=', 'auth_userprofile.user_id')->wherecourse_id($course_id)->wherecountry('EX')->select('id')->count();

			$total = $AG + $BC + $BS + $CC + $CS + $CH + $CL + $CM + $DF + $DG + $GT + $GR + $HG + $JC + $MC + $MN + $MS + $NT + $NL + $OC + $PL + $QT + $QR + $SP + $SL + $SR + $TC + $TS + $TL + $VZ + $YN + $ZS + $EX;

			$geo = array($AG, $BC, $BS, $CC, $CS, $CH, $CL, $CM, $DF, $DG, $GT, $GR, $HG, $JC, $MC, $MN, $MS, $NT, $NL, $OC, $PL, $QT, $QR, $SP, $SL, $SR, $TC, $TS, $TL, $VZ, $YN, $ZS, $EX, $total);

			$course_name = session()->get('course_name');

			return view('usuarios/geo') -> with('geo', collect($geo))->with('name_user', $username )-> with('course_name', $course_name);

		}else

				return view('accescourse');

    }

    public function desercion(){

			$super_user = session()->get('super_user');
			$course_name = session()->get('course_name');
			$course_id = session()->get('course_id');

        if( session()->get('course_name') == NULL){
            return $this->correoacurso();

        }elseif((session()->get('accescourse') > 0) || ($super_user == "1")) {

            $username = session()->get('nombre');

            $course_name = session()->get('course_name');

            $desercion = DB::table('vm_desercion')->wherecourse_name($course_name)->get();

            $json = json_encode ($desercion);

            return view('usuarios/desercion') -> with('desercion', $json)->with('name_user', $username )-> with('course_name', $course_name);

        }else{

            $username = session()->get('nombre');
            return view('accescourse');
        }
    }

		public function logout(){
			session()->flush();

			return view('logout');
		}
}
