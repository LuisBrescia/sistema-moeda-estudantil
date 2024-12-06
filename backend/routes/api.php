<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\TransacaoController;
use App\Http\Controllers\AuthController;

use App\Models\Departamento;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('login/professor', [AuthController::class, 'loginProfessor']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('instituicoes/all', [\App\Http\Controllers\InstituicaoController::class, 'all']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('alunos', AlunoController::class);
    Route::apiResource('professores', ProfessorController::class);
    Route::apiResource('empresas', EmpresaController::class);
    Route::apiResource('transacoes', TransacaoController::class);

    Route::get('/me', function (Request $request) {
        $departamento = Departamento::findOrFail($request->user()->departamento_id)->nome;

        return response()->json([
            'user' => $request->user(),
            'departamento' => $departamento
        ]);
    });

    Route::get('professor/resgatar', [ProfessorController::class, 'resgatar']);
    Route::put('aluno/adicionar_saldo', [AlunoController::class, 'adicionar']);
    Route::get('aluno/podio', [AlunoController::class, 'podio']);
    Route::put('aluno/comprar', [AlunoController::class, 'comprar']);
});


Route::get('/example', function () {
    return response()->json(['message' => 'API route is working']);
});
