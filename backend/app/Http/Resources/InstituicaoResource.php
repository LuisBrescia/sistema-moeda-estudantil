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
            'nome' => $this->nome,
            'categoria' => $this->categoria,
            'descricao' => $this->descricao,
            'logo' => $this->logo,
            'departamentos' => DepartamentoResource::collection($this->whenLoaded('departamentos')),
        ];
    }
}
