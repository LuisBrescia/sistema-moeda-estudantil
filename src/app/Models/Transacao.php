<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    use HasFactory;

    protected $fillable = ['professor_id', 'aluno_id', 'empresa_id', 'quantidade', 'tipo', 'descricao'];

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
