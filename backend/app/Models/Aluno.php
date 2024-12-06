<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Aluno extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'alunos';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'rg',
        'endereco',
        'instituicao_id',
        'departamento_id',
        'senha',
        'saldo',
        'historico',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
        'historico',
    ];


    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
        ];
    }

    public function transacoesRecebidas()
    {
        return $this->hasMany(Transacao::class, 'aluno_id');
    }
}
