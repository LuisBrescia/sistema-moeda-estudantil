<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlunoAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (isset($this->id)) {
            return $this->jsonReturn($this);
        }

        return $this->resource->map(function ($item) {
            return $this->jsonReturn($item);
        });
    }

    public function jsonReturn($item)
    {
        return [
            'id' => $item->id,
            'nome' => $item->nome,
            'email' => $item->email,
            'cpf' => $item->cpf,
            'rg' => $item->rg,
            'endereco' => $item->endereco,
            'instituicao_id' => $item->instituicao_id,
            'departamento_id' => $item->departamento_id,
            'saldo' => $item->saldo,
        ];
    }
}
