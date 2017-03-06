<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Course_name;
use Illuminate\Http\Request;
use Session;
use App\Model\Auth_userprofile;
use App\Model\Institucion;

class Course_nameController extends Controller
{
    
    public function __construct() {

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    

        
    public function index()
    {
         $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        $course_name = Course_name::paginate(7);

        return view('admin.course_name.index', compact('course_name'))->with('name_user', $username);
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
        
        $requestData = $request->all();
        
        Course_name::create($requestData);

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
        $username = session()->get('nombre');
        $course_name = Course_name::findOrFail($id);

        return view('admin.course_name.show', compact('course_name'))->with('name_user', $username);
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
        $username = session()->get('nombre');
        $course_name = Course_name::findOrFail($id);
        $siglas_institucion = \App\Model\Institucion::all()->pluck('siglas','siglas')->all();
        $nombre_institucion = \App\Model\Institucion::all()->pluck('nombre_institucion','nombre_institucion')->all();
        $institucion = $course_name->institucion;
        $nombre = $course_name->nombre_institucion;
        return view('admin.course_name.edit', compact('course_name'))
                  ->with('name_user', $username)
                  ->with('siglas_institucion',$siglas_institucion)
                  ->with('nombre_institucion',$nombre_institucion)
                  ->with('nombre',$nombre)
                  ->with('institucion',$institucion);
//        dd($siglas_institucion);
//        dd($course_name->nombre_institucion);
//          dd($nombre_institucion);        
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

        Session::flash('flash_message', 'Course_name updated!');

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
        $course_name = Course_name::find($id);
        $course_name->activo = 0;
        $course_name->save();            

        Session::flash('flash_message', 'Curso Inactivo!');

        return redirect('admin/course_name');
    }
}
