<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Professor extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'professores';

    protected $fillable = [
        'nome',
        'cpf',
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

    public function transacoesEnviadas()
    {
        return $this->hasMany(Transacao::class, 'professor_id');
    }
}
