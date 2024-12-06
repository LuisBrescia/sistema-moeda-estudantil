<?php

namespace Database\Factories;

use App\Models\Departamento;
use App\Models\Professor;
use App\Models\Aluno;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartamentoFactory extends Factory
{
    protected $model = Departamento::class;

    public function definition()
    {
        return [
            'instituicao_id' => null, // Será definido ao associar com Instituicao
            'descricao' => $this->faker->paragraph,
        ];
    }

    public function withAlunos()
    {
        return $this->has(
            Aluno::factory()
                ->count(rand(8, 16))
                ->state(function (array $attributes, Departamento $departamento) {
                    return [
                        'instituicao_id' => $departamento->instituicao_id, // Copia a instituição do departamento
                    ];
                }),
            'alunos' // Nome da relação no modelo Departamento
        );
    }

    public function withProfessores()
    {
        return $this->has(
            Professor::factory()
                ->count(rand(2, 5)),
            'professores' // Nome da relação no modelo Departamento
        );
    }
}
