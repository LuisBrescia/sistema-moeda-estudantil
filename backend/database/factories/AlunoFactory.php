<?php

namespace Database\Factories;

use App\Models\Aluno;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AlunoFactory extends Factory
{
    protected $model = Aluno::class;

    public function definition()
    {
        return [
            'nome'             => Str::limit($this->faker->name(), 20, ''),
            'email'            => $this->faker->unique()->safeEmail(),
            'cpf'              => $this->faker->unique()->numerify('###########'), // CPF sem máscara
            'rg'               => $this->faker->unique()->numerify('#########'), // RG sem máscara
            'endereco'         => $this->faker->numerify('########'), // CEP sem máscara
            'instituicao_id'   => null,
            'departamento_id'  => null, // Será definido ao associar com Departamento
            'saldo'            => $this->faker->randomFloat(2, 0, 1000),
            'senha'            => Hash::make('aluno'),
            'remember_token'   => Str::random(10),
        ];
    }
}
