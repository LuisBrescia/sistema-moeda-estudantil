<?php

namespace Database\Factories;

use App\Models\Instituicao;
use App\Models\Departamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class InstituicaoFactory extends Factory
{
    protected $model = Instituicao::class;

    protected $departamentoNomes = [
        'Artes Cênicas',
        'Artes Visuais',
        'Biologia',
        'Ciências Sociais',
        'Ciências Exatas',
        'Engenharia',
        'Tecnologia',
    ];

    public function definition()
    {
        return [
            'nome'      => $this->faker->company,
            'categoria' => $this->faker->randomElement(['Privada', 'Federal', 'Estadual', 'Municipal']),
            'descricao' => $this->faker->paragraph,
            'logo'      => $this->faker->imageUrl(200, 200, 'business', true, 'Logo'),
        ];
    }

    public function withDepartamentos()
    {
        $possibleNomes = $this->departamentoNomes;

        $count = rand(4, 7);
        $count = min($count, count($possibleNomes));

        shuffle($possibleNomes);
        $selectedNomes = array_slice($possibleNomes, 0, $count);

        $nomeSequence = array_map(function ($nome) {
            return ['nome' => $nome];
        }, $selectedNomes);

        return $this->has(
            Departamento::factory()
                ->count($count)
                ->withProfessores()
                ->state(new Sequence(...$nomeSequence)),
            'departamentos' // Name of the relation in the Instituicao model
        );

        return $this->has(
            Departamento::factory()
                ->count(rand(4, 7))
                ->withProfessores(),
            'departamentos' // Nome da relação no modelo Instituicao
        );
    }
}
