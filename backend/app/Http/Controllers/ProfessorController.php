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

    public function resgatar(Request $request)
    {
        $professor = auth()->user();

        if (!$professor instanceof Professor) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if (!$professor->canRedeem()) {
            $nextRedeemTime = $professor->ultima_vez_resgatado->copy()->addMinutes(5);
            $secondsLeft = now()->diffInSeconds($nextRedeemTime, false);
            $secondsLeft = max(0, $secondsLeft);
            $minutesLeft = ceil($secondsLeft / 60);

            return response()->json([
                'message' => "Você precisa esperar $minutesLeft minuto(s) antes de resgatar novamente.",
                'tempo_restante' => $secondsLeft,
            ], 200);
        }

        // Perform the redeem action
        $amount = 1000; // Adjust the amount as needed
        $professor->saldo += $amount;
        $professor->ultima_vez_resgatado = now();
        $professor->save();

        return response()->json([
            'message' => 'Resgate realizado com sucesso!',
            'saldo' => $professor->saldo,
            'ultima_vez_resgatado' => $professor->ultima_vez_resgatado,
        ], 200);
    }
}
