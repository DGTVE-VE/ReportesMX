<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\model\banner_principal;
use Illuminate\Http\Request;
use Session;

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
        
        $requestData = $request->all();
        
        $banner_principal = banner_principal::findOrFail($id);
        $banner_principal->update($requestData);

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
