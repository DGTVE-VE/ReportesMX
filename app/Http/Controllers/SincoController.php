<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Auth_perfilusuario;
use App\Model\Auth_userprofile;
use App\Model\Auth_sinco;
use DB;

class SincoController extends Controller
{

    public function show(Request $request)
    {
      $id = $request->input('id');
      $var = Auth_perfilusuario::where('user_id', $id)->first();
      $auth = Auth_userprofile::whereuser_id($id)->first();

      if (isset($auth->country) && isset($auth->city) ) {

        if (empty($var->sinco_1)) {

            $list_1 = Auth_sinco::where('clave', '<', 10)->get();
            echo $_GET['callback'] . "(" . json_encode($list_1) . ")";
        }
        elseif (isset($var->sinco_1) && empty($var->sinco_2) ) {

            $list_2 = Auth_sinco::where('clave', '>', 10)->where('clave','<', 100)->where('clave', 'like', $var->sinco_1 . '%')->get();
            echo $_GET['callback'] . "(" . json_encode($list_2) . ")";
        }
        elseif (isset($var->sinco_1) && isset($var->sinco_2) && empty($var->sinco_3) ) {

            $list_3 = Auth_sinco::where('clave', '>', 100)->where('clave','<', 1000)->where('clave', 'like', $var->sinco_2 . '%')->get();
            echo $_GET['callback'] . "(" . json_encode($list_3) . ")";
        }
        elseif (isset($var->sinco_1) && isset($var->sinco_2) && isset($var->sinco_3) && empty($var->sinco_4) ) {

            $list_4 = Auth_sinco::where('clave', '>', 1000)->where('clave','<', 10000)->where('clave', 'like', $var->sinco_3 . '%')->get();
            echo $_GET['callback'] . "(" . json_encode($list_4) . ")";
        }
        elseif (isset($var->sinco_1) && isset($var->sinco_2) && isset($var->sinco_3) && isset($var->sinco_4)) {

            echo $_GET['callback'] . "(" . json_encode('0') . ")";
        }
      }
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $clave = $request->input('clave');

        $var = Auth_perfilusuario::where('user_id', $id)->first();

        if( empty($var) && strlen($clave) == 1 ){
          $usuario = new Auth_perfilusuario;
          $usuario->user_id = $id;
          $usuario->sinco_1 = $clave;
          $usuario->save();

        }else if(isset($var) && strlen($clave) == 2) {
          $var->sinco_2 = $clave;
          $var->save();

        }else if(isset($var) && strlen($clave) == 3) {
          $var->sinco_3 = $clave;
          $var->save();

        }else if(isset($var) && strlen($clave) == 4) {
          $var->sinco_4 = $clave;
          $var->save();
        }
    }
}
