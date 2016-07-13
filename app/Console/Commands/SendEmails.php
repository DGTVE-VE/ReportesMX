<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía correos al usuario';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $asunto = 'prueba';
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
}
