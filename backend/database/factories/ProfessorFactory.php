<?php

namespace Database\Factories;

use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfessorFactory extends Factory
{
    protected $model = Professor::class;

    public function definition()
    {
        return [
            'nome'             => $this->faker->name(),
            'cpf'              => $this->faker->unique()->numerify('###########'), // CPF sem máscara
            'departamento_id'  => null, // Será definido ao associar com Departamento
            'senha'            => Hash::make('professor'),
            'remember_token'   => Str::random(10),
        ];
    }
}
