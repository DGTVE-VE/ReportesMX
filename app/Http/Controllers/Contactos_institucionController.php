<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Contactos_institucion;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
class Contactos_institucionController extends Controller
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
        $institucion_id = Auth::user ()->institucion_id;
        $contactos_institucion = Contactos_institucion::
                where("institucion_id", $institucion_id)
                ->paginate(25);

        return view('instituciones.contactos_institucion.index', compact('contactos_institucion'))
                ->with('super_user', $super_user)
                ->with('name_user',$name_user);
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
        return view('instituciones.contactos_institucion.create')->with('super_user', $super_user)->with('name_user',$name_user);
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
        
        Contactos_institucion::create($requestData);

        Session::flash('flash_message', 'Contactos_institucion added!');

        return redirect('instituciones/contactos_institucion');
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
        $contactos_institucion = Contactos_institucion::findOrFail($id);

        return view('instituciones.contactos_institucion.show', compact('contactos_institucion'))->with('super_user', $super_user)->with('name_user',$name_user);
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
        $contactos_institucion = Contactos_institucion::findOrFail($id);

        return view('instituciones.contactos_institucion.edit', compact('contactos_institucion'))->with('super_user', $super_user)->with('name_user',$name_user);
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
        
        $contactos_institucion = Contactos_institucion::findOrFail($id);
        $contactos_institucion->update($requestData);

        Session::flash('flash_message', 'Contactos_institucion updated!');

        return redirect('instituciones/contactos_institucion');
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
        Contactos_institucion::destroy($id);

        Session::flash('flash_message', 'Contactos_institucion deleted!');

        return redirect('instituciones/contactos_institucion');
    }
}
