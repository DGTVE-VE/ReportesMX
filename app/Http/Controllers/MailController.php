<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Mail\Mailer;
use DB;
use Log;

class MailController extends Controller {


    public function __construct() {

        $this->middleware('auth', ['only' => ['create', 'sendmail']]);
    }

//    public function eco ($id){
//        print $id;
//    }
//    public function getTotalRecords (){
//        $count = DB::table('auth_user')->count();
//        print json_encode($count);
//    }

//    public function test (){
//        $mensaje = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in nisi eget libero placerat sodales a at arcu. Etiam vulputate consequat dignissim. Ut vel dictum sem. Proin magna purus, tincidunt accumsan augue sollicitudin, varius condimentum nulla. Sed et malesuada nisi. In hac habitasse platea dictumst. Suspendisse potenti. Morbi sit amet consectetur odio, at aliquam nulla. Integer imperdiet pharetra metus, sed luctus arcu facilisis vel. Vivamus volutpat diam in diam sodales, et semper elit lacinia. Proin elementum metus turpis, nec facilisis mauris lacinia in. Vivamus auctor arcu vel nulla semper sodales. Nullam non hendrerit eros. Vestibulum et turpis facilisis, mollis justo quis, convallis ipsum.';
//        $sent = Mail::send('emails.masivo', ['mensaje' => $mensaje],
//                    function( $message ){
//                        $message->from('mexicox@televisioneducativa.gob.mx', 'México X');
//                        $message->to('j.israel.toledo@gmail.com')
//                                ->subject('Asunto prueba');
//        });
//        if( ! $sent) dd("something wrong");
//        dd($sent);
//    }

    public function sendmail() {
      set_time_limit(60*60*24);
        if (Input::get('submit') === 'preview'){
            return $this->show();
        }else{

            $user = \Illuminate\Support\Facades\Auth::user ();
            $auth_user = \App\Model\Auth_user::where('email', $user->email)->first();
            $asunto = Input::get( 'asunto' );
            $mensaje = Input::get( 'mensaje' );
            $id = Input::get( 'id' );

            $count = DB::table('correo_masivo')->count();
            \App\Model\Correo_masivo::chunk(100, function($users)
            {
                // Correr como daemon a ver si ya no se alenta el front en respoder.

                foreach ($users as $user){
                    Log.info('Enviando correo a: '.$user->email);

                        try {
                            Mail::send('emails.masivo', ['mensaje' => $mensaje],
                                function( $message ) use ($user){
                                    $message->from('mexicox@televisioneducativa.gob.mx', 'México X');
                                    $message->to($user->email)
                                            ->subject($asunto);
                            });
                        } catch (Exception $e) {
                            Log.error ('Error enviando correo a: '.$user->email . ' -> '.$e->getMessage());
                        }

                }
            });
            return view ('mail.index')
                    ->with ('name_user', $auth_user->username)
                    ->with('info', "Serán enviados ". number_format($count). " correos.");
        }

    }

    // public function sendmail() {
    //
    //     if (Input::get('submit') === 'preview'){
    //         return $this->show();
    //     }else{
    //         $user = \Illuminate\Support\Facades\Auth::user ();
    //         $auth_user = \App\Model\Auth_user::where('email', $user->email)->first();
    //         $asunto = Input::get( 'asunto' );
    //         $mensaje = Input::get( 'mensaje' );
    //         $id = Input::get( 'id' );
    //         $this->dispatch(new \App\Jobs\SendEmail($asunto, $mensaje));
    //         $count = DB::table('correo_masivo')->count();
    //         return view ('mail.index')
    //                 ->with ('name_user', $auth_user->username)
    //                 ->with('info', "Serán enviados ". number_format($count). " correos.");
    //     }
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = \Illuminate\Support\Facades\Auth::user ();
        $auth_user = \App\Model\Auth_user::where('email', $user->email)->first();


        if ($auth_user->is_superuser == 1){
            return view ('mail.index')->with ('name_user', $auth_user->username);
        }
        return redirect ('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request) {
//        //
//    }

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

    public function unsuscribe (){
        $unsuscriber = new \App\Model\Unsuscribers;
        $unsuscriber->email = Input::get ('email');
        if (\App\Model\Unsuscribers::where ('email', $unsuscriber->email)->first() == NULL){
            $unsuscriber->save();
        }
        return view('mail.successfulUnsuscribe');
    }
}
