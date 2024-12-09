<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use App\Models\Professor;
use App\Models\Aluno;
use App\Events\MailerEvent;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    public function index()
    {
        return Transacao::all();
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'professor_id' => 'required|exists:professores,id',
            'aluno_id' => 'required|exists:alunos,id',
            'quantidade' => 'required|integer|min:1',
            'descricao' => 'required|string',
        ]);


        $professor = Professor::find($request->professor_id);
        $aluno = Aluno::find($request->aluno_id);


        if ($professor->saldo < $request->quantidade) {
            return response()->json(['error' => 'Saldo insuficiente'], 400);
        }


        $professor->saldo -= $request->quantidade;
        $aluno->saldo += $request->quantidade;


        $professor->save();
        $aluno->save();


        Transacao::create([
            'professor_id' => $request->professor_id,
            'aluno_id' => $request->aluno_id,
            'quantidade' => $request->quantidade,
            'tipo' => 'enviar',
            'descricao' => $request->descricao,
        ]);


        event(new MailerEvent($aluno, $request->quantidade));

        return response()->json(['message' => 'Moedas enviadas com sucesso!']);
    }

    public function destroy(Transacao $transacao)
    {

        $transacao->delete();
        return response()->json(null, 204);
    }
}
