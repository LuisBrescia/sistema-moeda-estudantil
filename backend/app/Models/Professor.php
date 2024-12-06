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
        'ultima_vez_resgatado',
        'historico',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
            'ultima_vez_resgatado' => 'datetime',
            'historico' => 'array',
        ];
    }

    public function transacoesEnviadas()
    {
        return $this->hasMany(Transacao::class, 'professor_id');
    }

    public function canRedeem()
    {
        if (is_null($this->ultima_vez_resgatado)) {
            return true;
        }

        $nextRedeemTime = $this->ultima_vez_resgatado->copy()->addMinutes(1);
        return now()->greaterThanOrEqualTo($nextRedeemTime);
    }
}
