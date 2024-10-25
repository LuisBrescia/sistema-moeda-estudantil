<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'cpf', 'rg', 'endereco', 'instituicao', 'curso', 'saldo'];

    public function transacoesRecebidas()
    {
        return $this->hasMany(Transacao::class, 'aluno_id');
    }

    public function resgates()
    {
        return $this->hasMany(Transacao::class)->where('tipo', 'resgatar');
    }
}
