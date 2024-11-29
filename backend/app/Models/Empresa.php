<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'descricao'];

    public function transacoes()
    {
        return $this->hasMany(Transacao::class, 'empresa_id');
    }
}
