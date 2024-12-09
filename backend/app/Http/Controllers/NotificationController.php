<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Events\MailerEvent;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendEmailNotification(Request $request)
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $aluno = Aluno::findOrFail($request->aluno_id);

        
        event(new MailerEvent($aluno, $request->quantidade));

        return response()->json(['message' => 'E-mail enviado com sucesso!']);
    }
}
