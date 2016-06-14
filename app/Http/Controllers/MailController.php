<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Support\Facades\Input;
use DB;

class MailController extends Controller {


    public function eco ($id){
        print $id;
    }
    public function getTotalRecords (){
        $count = DB::table('auth_user')->count();
//        $count = \App\Model\Auth_user::all ()->count ();
        print json_encode($count);
    }        
    
    public function test (){
        $mensaje = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in nisi eget libero placerat sodales a at arcu. Etiam vulputate consequat dignissim. Ut vel dictum sem. Proin magna purus, tincidunt accumsan augue sollicitudin, varius condimentum nulla. Sed et malesuada nisi. In hac habitasse platea dictumst. Suspendisse potenti. Morbi sit amet consectetur odio, at aliquam nulla. Integer imperdiet pharetra metus, sed luctus arcu facilisis vel. Vivamus volutpat diam in diam sodales, et semper elit lacinia. Proin elementum metus turpis, nec facilisis mauris lacinia in. Vivamus auctor arcu vel nulla semper sodales. Nullam non hendrerit eros. Vestibulum et turpis facilisis, mollis justo quis, convallis ipsum.';
        $sent = Mail::send('emails.masivo', ['mensaje' => $mensaje], 
                    function( $message ){
                        $message->from('mexicox@televisioneducativa.gob.mx', 'México X');
                        $message->to('j.israel.toledo@gmail.com')
                                ->subject('Asunto prueba');
        });
        if( ! $sent) dd("something wrong");
        dd($sent);
    }
    
    public function sendmail() {
        $asunto = Input::get( 'asunto' );
        $mensaje = Input::get( 'mensaje' );
        $id = Input::get( 'id' );
//        $user = \App\Model\Auth_user::find($id);
        $this->dispatch(new \App\Jobs\SendEmail($asunto, $mensaje));
        $count = DB::table('auth_user')->count();
//        $users = \App\Model\Auth_user::all();        
//        $i = 0;
//        foreach ($users as $user){
//            $this->dispatch(new \App\Jobs\SendEmail($user, $asunto, $mensaje));
//            $i++;
//        }
        return view ('mail.index')->with('info', "Serán enviados ". number_format($count). " correos.");
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

        print 'index Mail';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view ('mail.index');
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
