<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstituicaoResource extends JsonResource
{
    /**
     * Transforma o recurso em um array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->franquia_id,
            'categoria' => $this->nome_fantasia,
            'descricao' => $this->cidade,
            'logo' => $this->logradouro,
            'departamentos' => DepartamentoResource::collection($this->whenLoaded('departamentos')),
        ];
    }
}
