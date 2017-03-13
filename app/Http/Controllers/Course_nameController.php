<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Course_name;
use App\Model\Course_overviews;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Model\Institucion;

class Course_nameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $super_user = session()->get('super_user');
        $name_user = session()->get('nombre');
        $course_name = Course_name::paginate(10);
        return view('admin.course_name.index', compact('course_name'))->with('super_user', $super_user)->with('name_user',$name_user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $super_user = session()->get('super_user');
        $name_user = session()->get('nombre');        
        $institucion = Institucion::all()->pluck('siglas','siglas');
        $institucion_nombre = Institucion::all()->pluck('nombre_institucion','nombre_institucion');
        $course_name = Course_name::orderBy('id', 'desc')->first();
        return view('admin.course_name.create')
            ->with('super_user', $super_user)
            ->with('name_user',$name_user)
            ->with('institucion',$institucion)
            ->with('course_name',$course_name)
            ->with('institucion_nombre',$institucion_nombre);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
            /*  Agregar nuevo registro a tabla con datos recabados  */
        $requestData = $request->all();
        $buscaCurso = Course_name::create($requestData);
            /* busqueda de nombre de curso por id*/
        $idCurso = $request->course_id;
        $curso = Course_overviews::where('id',$idCurso)->get();
            /*  Armar clave de reedición    */
        $nombreCurso = $curso[0]->display_name;
        $institucion = $request->institucion;
        $cveReedicion = $institucion.'_'.$nombreCurso;
            /*  Actualizar course_name, cursos con misma clave reedicion  */
        Course_name::where('reedicion', $cveReedicion)->update(['activo'=>0]);
            /*  Actualizar clave reedición en curso agregado recientemente  */
        $buscaCurso->reedicion = $cveReedicion;
        $buscaCurso->save();

        Session::flash('flash_message', 'Course_name added!');

        return redirect('admin/course_name');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $super_user = session()->get('super_user');
        $name_user = session()->get('nombre');        
        $course_name = Course_name::findOrFail($id);

        return view('admin.course_name.show', compact('course_name'))->with('super_user', $super_user)->with('name_user',$name_user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $super_user = session()->get('super_user');
        $name_user = session()->get('nombre');      
        $course_name = Course_name::findOrFail($id);
        $institucion = Institucion::all()->pluck('siglas','siglas');
        $institucion_nombre = Institucion::all()->pluck('nombre_institucion','siglas');

        return view('admin.course_name.edit', compact('course_name'))
            ->with('super_user', $super_user)
            ->with('name_user',$name_user)
            ->with('institucion',$institucion)
            ->with('institucion_nombre',$institucion_nombre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $course_name = Course_name::findOrFail($id);
        $course_name->update($requestData);

//       Log::info('Curso Agregado');

        return redirect('admin/course_name');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Course_name::destroy($id);

        Session::flash('flash_message', 'Course_name deleted!');

        return redirect('admin/course_name');
    }
}
