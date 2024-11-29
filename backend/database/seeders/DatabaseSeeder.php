<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instituicao;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Instituicao::factory()
            ->count(5)
            ->withDepartamentos()
            ->create();
    }
}
