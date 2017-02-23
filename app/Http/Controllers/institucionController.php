<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\institucion;
use Illuminate\Http\Request;
use Session;

class institucionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $super_user = session()->get('super_user');
        $name_user = session()->get('nombre');
        $institucion = institucion::paginate(10);

        return view('instituciones.institucion.index', compact('institucion'))->with('super_user', $super_user)->with('name_user',$name_user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $super_user = session()->get('super_user');
        $name_user = session()->get('nombre');
        return view('instituciones.institucion.create')->with('name_user', $name_user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $requestData = $request->all();

        institucion::create($requestData);

        Session::flash('flash_message', 'institucion added!');

        return redirect('instituciones/institucion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $super_user = session()->get('super_user');
        $name_user = session()->get('nombre');
        $institucion = institucion::findOrFail($id);

        return view('instituciones.institucion.show', compact('institucion'))->with('name_user', $name_user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $super_user = session()->get('super_user');
        $name_user = session()->get('nombre');
        $institucion = institucion::findOrFail($id);

        return view('instituciones.institucion.edit', compact('institucion'))->with('name_user', $name_user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {

        $requestData = $request->all();

        $institucion = institucion::findOrFail($id);
        $institucion->update($requestData);

        Session::flash('flash_message', 'institucion updated!');

        return redirect('instituciones/institucion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        institucion::destroy($id);

        Session::flash('flash_message', 'institucion deleted!');

        return redirect('instituciones/institucion');
    }

}
