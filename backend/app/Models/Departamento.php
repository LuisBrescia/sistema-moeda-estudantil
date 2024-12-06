<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'nome',
        'descricao',
        'instituicao_id',
    ];

    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function professores(): HasMany
    {
        return $this->hasMany(Professor::class);
    }

    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }
}
