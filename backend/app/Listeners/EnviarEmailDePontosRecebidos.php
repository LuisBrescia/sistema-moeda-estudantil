<?php

namespace App\Listeners;

use App\Events\MailerEvent;
use App\Mail\PontosRecebidos;
use Illuminate\Support\Facades\Mail;

class EnviarEmailDePontosRecebidos
{
    public function handle(MailerEvent $event)
    {
        
        Mail::to($event->aluno->email)->send(new PontosRecebidos($event->aluno, $event->pontos));
    }
}
