<?php

namespace App\Events;

use App\Models\Aluno;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MailerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $aluno;
    public $pontos;

    public function __construct(Aluno $aluno, int $pontos)
    {
        $this->aluno = $aluno;
        $this->pontos = $pontos;
    }
}
