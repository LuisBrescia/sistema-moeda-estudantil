<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instituicao_id')->constrained('instituicoes');
            $table->foreignId('departamento_id')->constrained('departamentos');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->string('endereco');
            $table->string('senha');
            $table->decimal('saldo', 10, 2)->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_alunos');
    }
};
