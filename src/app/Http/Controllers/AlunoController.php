<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        return Aluno::all();
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
}
