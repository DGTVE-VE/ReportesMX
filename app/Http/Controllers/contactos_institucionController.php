<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\contactos_institucion;
use Illuminate\Http\Request;
use Session;
use App\Model\Auth_userprofile;
use App\Model\institucion;

class contactos_institucionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {        
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');

        $user = \Illuminate\Support\Facades\Auth::user();
        $institucion = \App\User::where('email', $user->email)->first();
        
//        dd($institucion->institucion_id);
        $contactos_institucion  = contactos_institucion::where('institucion_id', '=', $institucion->institucion_id)->paginate(10);
        return view('instituciones.contactos_institucion.index', compact('contactos_institucion'))->with('name_user', $username);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        return view('instituciones.contactos_institucion.create')->with('name_user', $username);
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

        contactos_institucion::create($requestData);

        Session::flash('flash_message', 'contactos_institucion added!');

        return redirect('instituciones/contactos_institucion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show() {
        $super_user = session()->get('super_user');
        $username = session()->get('nombre');
        $user = \Illuminate\Support\Facades\Auth::user();
        $institucion = \App\User::where('email', $user->email)->first();        
        $contactos_institucion  = contactos_institucion::where('institucion_id', '=', $institucion->institucion_id)->paginate(10);
//        dd($contactos_institucion);
        return view('instituciones.contactos_institucion.show')->with('name_user', $username)->with('contactos_institucion',$contactos_institucion);
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
        $username = session()->get('nombre');
        $contactos_institucion = contactos_institucion::findOrFail($id);
        return view('instituciones.contactos_institucion.edit', compact('contactos_institucion'))->with('name_user', $username);
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

        $contactos_institucion = contactos_institucion::findOrFail($id);
        $contactos_institucion->update($requestData);

        Session::flash('flash_message', 'contactos_institucion updated!');

        return redirect('instituciones/contactos_institucion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        contactos_institucion::destroy($id);

        Session::flash('flash_message', 'contactos_institucion deleted!');

        return redirect('instituciones/contactos_institucion');
    }

    
    public function contactos($id){
        $institucion = contactos_institucion::where('institucion_id','=',$id);
//        dd($institucion);
    }
}
