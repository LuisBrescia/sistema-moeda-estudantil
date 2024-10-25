<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
        return Professor::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|unique:professores',
            'departamento' => 'required|string',
        ]);

        $professor = Professor::create($validated);

        return response()->json($professor, 201);
    }

    public function show(Professor $professor)
    {
        return response()->json($professor);
    }

    public function update(Request $request, Professor $professor)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|unique:professores,cpf,' . $professor->id,
            'departamento' => 'required|string',
        ]);

        $professor->update($validated);

        return response()->json($professor);
    }

    public function destroy(Professor $professor)
    {
        $professor->delete();
        return response()->json(null, 204);
    }
}
