<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InstituicaoCollection extends ResourceCollection
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
            'data' => InstituicaoResource::collection($this->collection),
        ];
    }

    /**
     * Adiciona meta dados adicionais à resposta.
     *
     * @param  Request  $request
     * @return array
     */
    // public function with($request)
    // {
    //     return [
    //         'meta' => [
    //             'current_page' => $this->resource->currentPage(),
    //             'from' => $this->resource->firstItem(),
    //             'last_page' => $this->resource->lastPage(),
    //             'per_page' => $this->resource->perPage(),
    //             'to' => $this->resource->lastItem(),
    //             'total' => $this->resource->total(),
    //         ],
    //         'links' => [
    //             'first' => $this->resource->url(1),
    //             'last' => $this->resource->url($this->resource->lastPage()),
    //             'prev' => $this->resource->previousPageUrl(),
    //             'next' => $this->resource->nextPageUrl(),
    //         ],
    //     ];
    // }
}
