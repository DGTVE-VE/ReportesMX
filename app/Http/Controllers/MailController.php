<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Support\Facades\Input;

class MailController extends Controller {

//    public function __construct() {
//
//        $this->middleware('auth',
//            ['only' => ['index']]);
//    }

    public function sendmail() {
        $asunto = Input::get( 'asunto' );
        $mensaje = Input::get( 'mensaje' );
        $course_id = Input::get( 'course_id' );

        //TODO obtener los correos con base al course_id
        // Si el course_id es TODOS entonces recupera TODOS los correos.
        Mail::send(
                'emails.masivo',
                array('firstName' => 'Israel'),
                function( $message ) use ($asunto) {
                    $message->from('mexicox@televisioneducativa.gob.mx', 'México X');
                    $message->to('j.israel.toledo@gmail.com')
                            ->subject($asunto);
                }
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // $courses_names = session()->get('courses_names');
        //
        // print_r($courses_names);

        return view ('mail.index');//->with('courses_names', $courses_names);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {

        $asunto = Input::get( 'asunto' );
        $mensaje = Input::get ('mensaje');

        return view ('emails.masivo')
                ->with ('asunto',$asunto)
                ->with ('mensaje', $mensaje);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
