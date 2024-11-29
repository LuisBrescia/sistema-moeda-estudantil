<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'rg',
        'endereco',
        'instituicao_id',
        'departamento_id',
        'saldo',
        'senha',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
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
