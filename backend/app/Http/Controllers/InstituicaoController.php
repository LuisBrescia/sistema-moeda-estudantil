<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use App\Http\Resources\InstituicaoResource;
use App\Http\Resources\InstituicaoCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstituicaoController extends Controller
{
    /**
     * Lista todas as unidades com paginação.
     *
     * @return InstituicaoCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $perPage = is_numeric($perPage) && $perPage > 0 ? (int)$perPage : 10;

        $user = $request->user();
        $instituicoes = $user->unidades()->paginate($perPage);

        return new InstituicaoCollection($instituicoes);
    }

    /**
     * Exibe uma unidade específica.
     *
     * @param  int  $id
     * @return InstituicaoResource
     */
    public function show($id)
    {
        $unidade = Instituicao::findOrFail($id);
        return new InstituicaoResource($unidade);
    }

    /**
     * Cria uma nova unidade.
     *
     * @param  Request  $request
     * @return InstituicaoResource
     */
    public function store(Request $request)
    {
        $user = $request->user(); // ou $user = Auth::user();
        // 'franquia_id' => 'required|exists:franquias,id',
        $validatedData = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'cep' => 'required|string|max:20',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'foto' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        // * Tirando todos caracteres não numéricos do telefone
        $validatedData['telefone'] = preg_replace('/\D/', '', $validatedData['telefone']);
        $unidade = Instituicao::create($validatedData);

        return (new InstituicaoResource($unidade))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Atualiza uma unidade existente.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return InstituicaoResource
     */
    public function update(Request $request, $id)
    {
        $unidade = Instituicao::findOrFail($id);

        $validatedData = $request->validate([
            'franquia_id' => 'sometimes|required|exists:franquias,id',
            'nome_fantasia' => 'sometimes|required|string|max:255',
            'cidade' => 'sometimes|required|string|max:255',
            'logradouro' => 'sometimes|required|string|max:255',
            'cep' => 'sometimes|required|string|max:20',
            'telefone' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|required|email|max:255',
            'foto' => 'nullable|string|max:255',
            'ativo' => 'boolean',
        ]);

        $unidade->update($validatedData);

        return new InstituicaoResource($unidade);
    }

    /**
     * Remove uma unidade.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $unidade = Instituicao::findOrFail($id);
        $unidade->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Lista todas as unidades com paginação sem middleware.
     *
     * @return InstituicaoCollection
     */
    public function all(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $perPage = is_numeric($perPage) && $perPage > 0 ? (int)$perPage : 10;

        $instituicoes = Instituicao::with('departamentos')->paginate($perPage);

        return new InstituicaoCollection($instituicoes);
    }
}
