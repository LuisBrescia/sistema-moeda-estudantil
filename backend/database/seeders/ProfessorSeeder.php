<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessorSeeder extends Seeder
{
    public function run()
    {
        DB::table('professores')->insert([
            'departamento_id' => 1,  
            'nome' => 'Professor Teste',
            'cpf' => '55294868008',
            'senha' => bcrypt('professor'),  
            'saldo' => 0.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
