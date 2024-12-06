<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Container\Attributes\Auth;
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
        $professor = $request->user();

        if (!$professor instanceof Professor) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $ultimaVezResgatado = $professor->ultima_vez_resgatado ?? now()->subMinutes(1);
        $nextRedeemTime = $ultimaVezResgatado->copy()->addMinutes(1);
        $secondsLeft = now()->diffInSeconds($nextRedeemTime, false);
        $isAvailable = $secondsLeft <= 0;

        if ($request->query('status') === 'true') {
            // Apenas retorna o status sem alterar saldo ou tempo
            return response()->json([
                'disponivel' => $isAvailable,
                'tempo_restante' => $isAvailable ? 0 : max(0, $secondsLeft),
            ], 200);
        }

        if (!$isAvailable) {
            $minutesLeft = ceil(max(0, $secondsLeft) / 60);

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
