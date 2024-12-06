<?php

namespace Database\Factories;

use App\Models\Instituicao;
use App\Models\Departamento;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return $this->afterCreating(function (Instituicao $instituicao) {
            $possibleNomes = $this->departamentoNomes;

            $count = rand(4, 7);
            $count = min($count, count($possibleNomes));

            shuffle($possibleNomes);
            $selectedNomes = array_slice($possibleNomes, 0, $count);

            foreach ($selectedNomes as $nome) {
                Departamento::factory()
                    ->withProfessores()
                    ->withAlunos()
                    ->create([
                        'instituicao_id' => $instituicao->id,
                        'nome'           => $nome,
                    ]);
            }
        });
    }
}
