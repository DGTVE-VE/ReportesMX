<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;

use App\Model\banner_principal;

class banner_principalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $banner_principal = banner_principal::paginate(25);
        $usuario = session()->get('nombre');
        return view('admin.banner_principal.index', compact('banner_principal'))->with('name_user',$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $usuario = session()->get('nombre');
        return view('admin.banner_principal.create')->with('name_user',$usuario);
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
        
        banner_principal::create($requestData);

        Session::flash('flash_message', 'banner_principal added!');
        $usuario = session()->get('nombre');

        return redirect('admin/banner_principal')->with('name_user',$usuario);
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
        $banner_principal = banner_principal::findOrFail($id);
        $usuario = session()->get('nombre');

        return view('admin.banner_principal.show', compact('banner_principal'))->with('name_user',$usuario);
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
        $banner_principal = banner_principal::findOrFail($id);
        $usuario = session()->get('nombre');

        return view('admin.banner_principal.edit', compact('banner_principal'))->with('name_user',$usuario);
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
        if ($_FILES['url_imagen']["error"] > 0){
            echo "Error: " . $_FILES['url_imagen']['error'] . "<br>";
        }
        else{
            echo "Nombre: " . $_FILES['url_imagen']['name'] . "<br>";
            echo "Tipo: " . $_FILES['url_imagen']['type'] . "<br>";
            echo "Tamaño: " . ($_FILES["url_imagen"]["size"] / 1024) . " kB<br>";
            echo "Carpeta temporal: " . $_FILES['url_imagen']['tmp_name'];
            move_uploaded_file($_FILES['url_imagen']['tmp_name'],
            "imagenes/banner/" . $_FILES['url_imagen']['name']);
            $requestData = $request->all();
        }
        
        $banner_principal = banner_principal::findOrFail($id);
        $banner_principal->update($requestData);
        $banner_principal->url_imagen = "imagenes/banner/" . $_FILES['url_imagen']['name'];
        $banner_principal->save();

        Session::flash('flash_message', 'banner_principal updated!');
        $usuario = session()->get('nombre');

        return redirect('admin/banner_principal')->with('name_user',$usuario);
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
        banner_principal::destroy($id);

        Session::flash('flash_message', 'banner_principal deleted!');
        $usuario = session()->get('nombre');

        return redirect('admin/banner_principal')->with('name_user',$usuario);
    }
}
