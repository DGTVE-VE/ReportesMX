<?php

namespace App\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Categorias;
use App\Model\CourseName;
use App\Model\Blog;
use App\Model\Auth_user;
use App\Model\Auth_userprofile;
use App\Model\CursoCategorias;

class MXController extends Controller {

  public function __construct() {

  }

  public function validarcp() {

    $codigo = filter_input(INPUT_GET, 'codigopostal');

    $direccion = DB::table('codigospostales')->wherecodigopostal($codigo)->get();

    if (empty($direccion)) {
      echo $_GET['callback'] . "(" . json_encode('0') . ")";
    } else {
      echo $_GET['callback'] . "(" . json_encode($direccion) . ")";
    }
  }

  public function verifica() {

    $id_usuario = filter_input(INPUT_GET, 'id');

    $city = Auth_userprofile::whereuser_id($id_usuario)->get();
    //$city1 = DB::table('users_info')->whereusers_id($id_usuario)->get();

    $country = Auth_userprofile::whereuser_id($id_usuario)->get();
    //$country1 = DB::table('users_info')->whereusers_id($id_usuario)->get();


    if (empty($country[0]->country) || ( $country[0]->country == NULL )) {

      //falta pais
      echo $_GET['callback'] . "(" . json_encode('0') . ")";
    } else if (( isset($country[0]->country) ) && ( ( empty($city[0]->city) ) || ( $city[0]->city == NULL ) )) {

      echo $_GET['callback'] . "(" . json_encode($country[0]->country) . ")";
    } else {
      //no falta nada
      echo $_GET['callback'] . "(" . json_encode('1') . ")";
    }
  }

  public function adddata() {

    $id_usuario = filter_input(INPUT_GET, 'id');
    $pais = filter_input(INPUT_GET, 'country');
    $estado = filter_input(INPUT_GET, 'state');
    $cp = filter_input(INPUT_GET, 'codigopostal');

    if (empty($pais)) {
      echo $_GET['callback'] . "(" . json_encode('Error country void') . ")";
      return 0;
    } else if (empty($estado)) {
      echo $_GET['callback'] . "(" . json_encode('Error state void') . ")";
      return 0;
    } else if (empty($cp)) {
      echo $_GET['callback'] . "(" . json_encode('Error cp void') . ")";
      return 0;
    } else {

      if ($pais == "MX") {
        $codigo = DB::table('codigospostales')->wherecodigopostal($cp)->get();
        if (empty($codigo)) {
          echo $_GET['callback'] . "(" . json_encode('Error invalid cp') . ")";
          return 0;
        }
      }

      //$exito = Auth_userprofile::where('user_id', $id_usuario)->update(['country' => $pais, 'city' => $estado, 'mailing_address' => $cp]);
      $exito = DB::table('edxapp.auth_userprofile')->where('user_id', $id_usuario)->update(['country' => $pais, 'city' => $estado, 'mailing_address' => $cp]);

      if ($exito == 1) {
        print_r("Exito Update");
        echo $_GET['callback'] . "(" . json_encode('Success Update') . ")";
        return 1;
      } else {
        print_r("Error Update");
        echo $_GET['callback'] . "(" . json_encode('Error Update') . ")";
        return 0;
      }
    }
  }

  public function uploadvideo() {

    return view('upload.uploadvideo');
  }

  public function savevideo(Request $request) {

    $this->validate($request, [

      'inputEmai' => 'required|email|max:150',
      'inputText' => 'required|string|max:1000',
      'inputVideo' => 'required|max:20000',
    ]);

    $video = $request->file('inputVideo');
    $texto = $request->input('inputText');
    $email = $request->input('inputEmai');

    $id = DB::table('upload_video')->max('id');
    $id ++;
    \Storage::MakeDirectory($id);

    $vid = $video->getClientOriginalName();

    $route1 = \Storage::disk('local')->put($id . '/' . $vid, File::get($video));

    $exito = DB::table('upload_video')->insert(
    [
      'correo' => $email,
      'texto' => $texto,
      'ruta_video' => '/public/uploadvideos/' . $id . '',
    ]
  );

  if ($exito == 1) {
    return view('upload.success');
  } else {
    return "Ocurrio un error al subir el video.";
  }
}

public function blog(){
    $correo = \Auth::user() -> email;

//    if(empty($name = DB::table('edxapp.auth_user')->whereemail($correo)->get())){
//        return view("no_asociado_curso");
//    }
//    $username = $name[0]->username;
    $username = \Auth::user()->name;
    session()->put('nombre', $username);    
    $entradas = Blog::where('publico', 0)->orderBy('id', 'desc')->get();
    return view('blog.blog')->with('entradas', collect($entradas))->with('name_user',$username);
}

public function saveblog(Request $request){

  $correo = \Auth::user() -> email;

  if(empty($name = Auth_user::whereemail($correo)->first())){
    return view("no_asociado_curso");
  }

  if($name->is_superuser != 1)
  {
    return $this->blog();
  }
  $id_usuario = Auth_user::whereemail($correo)->first()->id;

  $this->validate($request, [
    'inputTitulo' => 'required|max:255',
    'inputAutor' => 'required|max:150',
    'inputCuerpo' => 'required',
    //'inputDate' => 'required|date|date_format:Y-m-d',
    'inputPublico' => 'required',
    'inputRef' => 'required|max:1000',
    'inputImagen' => 'required'
  ]);

    $inputTitulo = $request->input('inputTitulo');
    //$inputDate = $request->input('inputDate');
    $inputCuerpo = $request->input('inputCuerpo');
    $inputAutor = $request->input('inputAutor');
    $inputPublico = $request->input('inputPublico');
    $inputRef = $request->input('inputRef');
    $inputImagen = $request->file('inputImagen');

if( !empty(Blog::wheretitulo($inputTitulo)->first())){
  return $this->viewblog(Blog::wheretitulo($inputTitulo)->first()->id);
}
    $inputDate = date('Y-m-d');
    $idEntrada = Blog::insertGetId([
        'user_id' => $id_usuario,
        'titulo' => $inputTitulo,
        'fecha' => $inputDate,
        'cuerpo' => $inputCuerpo,
        'publico' => $inputPublico,
        'autor' => $inputAutor,
        'referencias' => $inputRef
    ]);

  \Storage::disk('local_public')->MakeDirectory($idEntrada);

  $img1 = $inputImagen->getClientOriginalName();

  $route1 = \Storage::disk('local_public')->put($idEntrada.'/'.$img1, File::get($inputImagen));

  Blog::where('id', $idEntrada)->update(['imagen' => $idEntrada.'/'.$img1]);

  return $this->viewblog($idEntrada);

}

public function viewblog($idEntrada){

  $entradas = Blog::where('publico', '0')->get();
  $entrada = Blog::whereid($idEntrada)->get();
  $usuario = session()->get('nombre');
  return view('blog.viewblog')->with('entradas', collect($entradas))->with('entrada', collect($entrada))->with('name_user',$usuario);

}

public function getblog(Request $request){

    $inputid = $request->input('id');

    return $this->viewblog($inputid);

}

public function adminblog(){

  $correo = \Auth::user() -> email;

  if(empty($name = Auth_user::whereemail($correo)->first())){
    return view("no_asociado_curso");
  }

  if($name->is_superuser != 1)
  {
    return $this->blog();
  }
  $usuario = session()->get('nombre');
  return view('blog.adminblog')->with('name_user',$usuario);

}

	public function categoria(){
		$categorias = Categorias::all();
		return view('vinculaCat')->with('categorias', $categorias);
	}

	public function consultaCurso(){
		$idCurso = $_POST['idCurso'];
		$curso = CourseName::where('course_id', $idCurso)->first();
		return $curso->course_name;
	}

	public function guardaCategoria(){
		$categorias = $_POST['arregloCat'];
		$idCurso = $_POST['idCurso'];
		$affectedRows = CursoCategorias::where('course_id', '=', $idCurso)->delete();
		foreach($categorias as $categoria){
			$cat = CursoCategorias::firstOrCreate(['course_id' => $idCurso, 'categoria_id' => $categoria]);
		}
	}
}
