<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\contactos_instit;
use Illuminate\Http\Request;
use Session;
use App\Model\Auth_userprofile;
use App\Model\institucion;

class contactos_institController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($institucion_id) {
        
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');

        $institucion = institucion::find($institucion_id);
        print($institucion);
//        
//        $contactos_instit = contactos_instit::paginate(25);
//
//        return view('instituciones.contactos_instit.index', compact('contactos_instit'))->with('name_user', $username)->with('institucion', $institucion);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($institucion_id) {
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        $institucion = institucion::find($institucion_id);
        return view('instituciones.contactos_instit.create')->with('name_user', $username)->with('institucion', $institucion);
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

        contactos_instit::create($requestData);

        Session::flash('flash_message', 'contactos_instit added!');

        return redirect('instituciones/contactos_instit');
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
        $username = session()->get('nombre');
        $contactos_instit = contactos_instit::findOrFail($id);

        return view('instituciones.contactos_instit.show', compact('contactos_instit'))->with('name_user', $username);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, $institucion_id) {
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        $institucion = institucion::find($institucion_id);
        $contactos_instit = contactos_instit::findOrFail($id);

        return view('instituciones.contactos_instit.edit', compact('contactos_instit'))->with('name_user', $username)->with('institucion', $institucion);
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

        $contactos_instit = contactos_instit::findOrFail($id);
        $contactos_instit->update($requestData);

        Session::flash('flash_message', 'contactos_instit updated!');

        return redirect('instituciones/contactos_instit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        contactos_instit::destroy($id);

        Session::flash('flash_message', 'contactos_instit deleted!');

        return redirect('instituciones/contactos_instit');
    }

}
