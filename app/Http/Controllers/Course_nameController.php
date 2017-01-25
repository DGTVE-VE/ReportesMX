<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Course_name;
use Illuminate\Http\Request;
use Session;
use App\Model\Auth_userprofile;

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
        $username = session()->get('nombre');
        $course_name = Course_name::paginate(25);

        return view('admin.course_name.index', compact('course_name'))->with('name_user', $username);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
                 $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        return view('admin.course_name.create')->with('name_user', $username);
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

        return view('admin.course_name.edit', compact('course_name'))->with('name_user', $username);
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
        Course_name::destroy($id);

        Session::flash('flash_message', 'Course_name deleted!');

        return redirect('admin/course_name');
    }
}
