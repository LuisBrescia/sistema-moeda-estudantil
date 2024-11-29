<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\TransacaoController;
use App\Http\Controllers\AuthController;

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
});

Route::get('/example', function () {
    return response()->json(['message' => 'API route is working']);
});
