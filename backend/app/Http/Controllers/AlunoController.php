<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Departamento;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $departamento_id = $request->user()->departamento_id;
        $departamento = Departamento::find($departamento_id);

        return response()->json($departamento->alunos);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos',
            'cpf' => 'required|unique:alunos',
            'rg' => 'required|unique:alunos',
            'endereco' => 'required|string',
            'instituicao' => 'required|string',
            'curso' => 'required|string',
        ]);

        $validated['rg'] = strtoupper($validated['rg']);
        $aluno = Aluno::create($validated);

        return response()->json($aluno, 201);
    }

    public function show(Aluno $aluno)
    {
        return response()->json($aluno);
    }

    public function update(Request $request, Aluno $aluno)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email,' . $aluno->id,
            'cpf' => 'required|unique:alunos,cpf,' . $aluno->id,
            'rg' => 'required|unique:alunos,rg,' . $aluno->id,
            'endereco' => 'required|string',
            'instituicao' => 'required|string',
            'curso' => 'required|string',
        ]);

        $aluno->update($validated);

        return response()->json($aluno);
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return response()->json(null, 204);
    }

    public function adicionar(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:alunos,id',
            'saldo' => 'required|numeric|min:1',
        ]);

        $validated['id'] = (int) $validated['id'];
        $validated['saldo'] = (float) $validated['saldo'];

        $professor = $request->user();

        if (!$professor instanceof Professor) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        if ($professor->saldo < $validated['saldo']) {
            return response()->json(['message' => 'Saldo insuficiente'], 400);
        }

        $aluno = Aluno::find($validated['id']);

        $professor->saldo -= $validated['saldo'];
        $historicoProfessor = $professor->historico ?? [];
        $historicoProfessor[] = [
            'tipo' => 'saida',
            'valor' => $validated['saldo'],
            'origem' => $aluno->nome,
            'date' => now(),
        ];
        $professor->historico = $historicoProfessor;

        $aluno->saldo += $validated['saldo'];
        $historicoAluno = $aluno->historico ?? [];
        $historicoAluno[] = [
            'tipo' => 'entrada',
            'valor' => $validated['saldo'],
            'origem' => $professor->nome,
            'date' => now(),
        ];
        $aluno->historico = $historicoAluno;

        $professor->save();
        $aluno->save();

        // > @VictorReisCarlota: Ação de enviar por email

        return response()->json($aluno);
    }

    public function podio()
    {
        $alunos = Aluno::all();
        $alunos = $alunos->sortByDesc('saldo')->values()->take(10)->all();

        // iterar por cada aluno e pegar o nome do departamento e instituicao
        foreach ($alunos as $aluno) {
            $insticuicao = Instituicao::find($aluno->instituicao_id);
            $departamento = Departamento::find($aluno->departamento_id);
            $aluno->departamento = $departamento->nome;
            $aluno->instituicao = $insticuicao->nome;
        }

        return response()->json($alunos);
    }

    public function comprar(Request $request)
    {
        $aluno = $request->user();

        if (!$aluno instanceof Aluno) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'valor' => 'required|numeric',
            'nome' => 'required|string',
        ]);

        $valor = (float) $validated['valor'];
        $produtoNome = $validated['nome'];

        if ($aluno->saldo < $valor) {
            return response()->json(['message' => 'Saldo insuficiente'], 400);
        }

        $aluno->saldo -= $valor;
        $historico = $aluno->historico ?? [];
        $historico[] = [
            'tipo' => 'saida',
            'valor' => $valor,
            'origem' => $produtoNome,
            'date' => now(),
        ];

        $aluno->historico = $historico;
        $aluno->vantagens += 1;
        $aluno->save();

        return response()->json($aluno);
    }
}
