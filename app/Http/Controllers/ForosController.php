<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ForosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Genera el archivo de foros
    public function generaArchivoForos() {
		$username = session()->get('nombre');
        $org = Auth::user()->institucion->siglas;
        $nomorg = Auth::user()->institucion->nombre_institucion;
        $cursos = DB::table('edxapp.course_overviews_courseoverview')->whereorg($org)->get();
        $totcur = sizeof($cursos);
        for ($i = 0; $i < $totcur; $i++) {
        exec("/usr/bin/mongoexport --host 172.31.10.135 --port 27017 --username edxapp --password password --authenticationDatabase edxapp --db cs_comments_service --collection contents --query '{ course_id: \"".$cursos[$i]->id."\" }' --csv --fields _id,comment_thread_id,parent_id,_type,thread_type,title,body,author_id,author_username,course_id,created_at,updated_at --out /var/www/reportes/public/download/foros_".$cursos[$i]->display_number_with_default.".csv");
        }
        return view('foros.foros_view_1')
			->with('name_user', $username)
            ->with('nombreorganizacion', $nomorg)
            ->with(array('cursos'=>$cursos))
            ->with('totalcursos', $totcur);
    }

}

