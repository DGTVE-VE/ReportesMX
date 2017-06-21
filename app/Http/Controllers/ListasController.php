<?php

namespace App\Http\Controllers;
use DB;
use File;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class ListasController extends Controller {

    public function __construct() {

    }

    public function listas(){

      $username = session()->get('nombre');
      $c_id = session()->get('course_id');
      $course_name = session()->get('course_name');

  		if($c_id == "" || $c_id == NULL){
                      $c_id = filter_input (INPUT_POST, 'course_id');
                      if($username == NULL || $c_id == "" || $c_id == NULL)
                          return app('App\Http\Controllers\UseController')->correoacurso();
                  }

      $lista =  DB::select(DB::raw('SELECT p.name, a.email, m.Pais FROM edxapp.auth_userprofile p
        inner join edxapp.auth_user a on a.id = p.user_id
        inner join mexicox.Paises m on m.Codigo = p.country
        left join edxapp.student_courseenrollment s on s.user_id = a.id
        where s.is_active = 1 and s.course_id = "'.$c_id.'"'));

      $fp = fopen('download/listas_'.$course_name.'.csv', 'w');

      $l = array('Nombre', 'Email', 'País');
        fputcsv($fp, $l);

      foreach ($lista as $key) {
        $array = array($key->name , $key->email, $key->Pais);
        fputcsv($fp, $array);
      }

      fclose($fp);

      return view('listas/listas')
      -> with('name_user', $username)
      -> with('course_name', $course_name)
      -> with('lista', collect($lista));

    }
}
