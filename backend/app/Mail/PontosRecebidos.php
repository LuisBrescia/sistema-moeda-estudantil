<?php

namespace App\Mail;

use App\Models\Aluno;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PontosRecebidos extends Mailable
{
    use Queueable, SerializesModels;

    public $aluno;
    public $quantidade;

    public function __construct(Aluno $aluno, int $quantidade)
    {
        $this->aluno = $aluno;
        $this->quantidade = $quantidade;
    }

    public function build()
    {
        return $this->subject('Você recebeu novos pontos!')
                    ->view('emails.pontos-recebidos');  // A view que vamos criar
    }
}
