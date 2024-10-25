<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf', 'departamento', 'saldo'];

    public function transacoesEnviadas()
    {
        return $this->hasMany(Transacao::class, 'professor_id');
    }
}
