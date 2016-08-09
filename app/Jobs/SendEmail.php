<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $user;
    protected $asunto;
    protected $mensaje;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($asunto, $mensaje)
    {

       $this->asunto = $asunto;
       $this->mensaje = $mensaje;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
//        $users = \App\Model\Auth_user::all();
        \App\Model\Auth_user::chunk(100, function($users) use ($mailer)
        {
            // Correr como daemon a ver si ya no se alenta el front en respoder.
            foreach ($users as $user){
                if (\App\Model\Unsuscribers::where ('email', $user->email)->first() == NULL){
                    try {
                        $mailer->send('emails.masivo', ['mensaje' => $this->mensaje],
                            function( $message ) use ($user){
                                $message->from('mexicox@televisioneducativa.gob.mx', 'México X');
                                $message->to($user->email)
                                        ->subject($this->asunto);
                        });
                        Log.error ('Enviando correo a: '.$user->email);
                    } catch (Exception $e) {
                        Log.error ('Error enviando correo a: '.$user->email . ' -> '.$e->getMessage());
                    }
                }
            }
        });
    }
}
