<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Constancias;
use App\Model\Auth_userprofile;

class ConstanciasController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    //Buscar por número de folio en la tabla de constancias
    public function constancias() {
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        $folio = filter_input(INPUT_GET, 'folio');
        $email = filter_input(INPUT_GET, 'email');

        if (isset($folio)) {
            $constan = Constancias::find($folio);
            return view('constancias/constancias')->with('constan', $constan)->with('name_user', $username);
        }
        elseif (isset($email)){
          $correo = Constancias::wherecorreo($email)->get();
          return view('constancias/constancias')->with('correo', $correo)->with('name_user', $username);
        }
        return view('constancias/constancias')->with('name_user', $username);
    }

    //Servicio web de la tabla de Auth_userprofile esta función va acompañada de un Scope del modelo de la tabla
    public function webService(Request $request) {
        $todoAuth = $request->all();
         return json_encode(Auth_userprofile::Search($todoAuth)->get()->toArray());
    }

}
