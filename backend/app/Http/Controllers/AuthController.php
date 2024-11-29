<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Professor;


use App\Http\Resources\AlunoAuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'cpf' => 'required|string|max:11',
            'rg' => 'required|string|max:9',
            'endereco' => 'required|string|max:255',
            'instituicao_id' => 'required|integer',
            'departamento_id' => 'required|integer',
            'senha' => 'required|string|min:8',
        ]);

        $aluno = Aluno::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'cpf' => $validated['cpf'],
            'rg' => $validated['rg'],
            'endereco' => $validated['endereco'],
            'instituicao_id' => $validated['instituicao_id'],
            'departamento_id' => $validated['departamento_id'],
            'senha' => Hash::make($validated['senha']),
            'saldo' => 0,
        ]);

        $alunoData = [
            'user' => new AlunoAuthResource($aluno),
            'access_token' => $aluno->createToken('api', ['aluno'])->plainTextToken
        ];

        return response()->json($alunoData, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $aluno = Aluno::where('email', $request->email)->first();

        if (!$aluno || !Hash::check($request->senha, $aluno->senha)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais estão incorretas.'],
            ]);
        }

        $token = $aluno->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout efetuado com sucesso!']);
    }
}
