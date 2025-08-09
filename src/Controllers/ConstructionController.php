<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Construction;
use App\Models\PDF;
use App\Utils\Render;
use App\Validations\ConstructionValidation;
use Exception;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;

class ConstructionController
{
    private Construction $construction_model;

    public function __construct()
    {
        $this->construction_model = new Construction();
    }

    public function __invoke()
    {
        $constructions = Construction::with('user')->get();

        return Render::render('Construction/Index', ["constructions" => $constructions]);
    }


    public function show(ServerRequestInterface $request, array $args)
    {
        $id = $args['id'];

        // Obtém a construção pelo ID
        $construction = $this->construction_model->with('budgets')->where('id', $id)->first();

        if (!$construction) {
            return Render::render('errors/404', ["message" => "Construção não encontrada"]);
        }

        // Renderiza a página de visualização (View)
        return Render::render('Construction/View', ["construction" => $construction]);
    }

    public function store(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();

        // $construction_validation  = new ConstructionValidation($data);

        // if ($construction_validation->validation->fails()) {
        //     $errors = $construction_validation->validation->errors();
        //     return new JsonResponse(["message" => "Erro ao salvar a construção", "status" => 503, "errors" => $errors->toArray()]);
        // }

        $construction = $this->construction_model->create($data);

        if (!$construction)
            return new JsonResponse(['message' => "Erro ao salvar a construção", "status" => 400]);

        return new JsonResponse(["message" => "Erro, construção não encontrada", "status" => 404]);
    }

    public function edit(ServerRequestInterface $request, array $args)
    {
        $id = $args['id'];
        $construction = $this->construction_model->where('id', $id)->first();

        if (!$construction) {
            return Render::render('errors/404', ["message" => "Construção não encontrada"]);
        }

        return Render::render('Construction/Edit', ["construction" => $construction]);
    }

    // Atualiza a construção
    public function update(ServerRequestInterface $request, array $args)
    {
        $data = $request->getParsedBody();
        // Verifique se a construção existe
        $id = $args['id'];
        $construction = $this->construction_model->where('id', $id)->first();

        if (!$construction) {
            return new JsonResponse(["message" => "Erro, construção não encontrada", "status" => 404]);
        }

        // Atualize a construção com os dados recebidos
        $updated = $construction->update($data);

        if (!$updated) {
            return new JsonResponse(["message" => "Erro ao atualizar a construção", "status" => 400]);
        }

        return new JsonResponse(["message" => "Construção atualizada com sucesso", "status" => 200]);
    }

    public function delete(ServerRequestInterface $request, array $args)
    {
        $id = $args['id'];

        $construction = $this->construction_model->where('id', $id)->first();

        if (!$construction)
            return new JsonResponse(["message" => "Erro, construção não encontrada", "status" => 404]);

        $deleted = $construction->delete();

        if (!$deleted)
            return new JsonResponse(["message" => "Erro, construção não deletada", "status" => 400]);

        return new JsonResponse(["message" => "Construção deletada com sucesso", "status" => 200]);
    }

    public function create()
    {

        $users = User::all();

        return Render::render('Construction/Create', ["users" => $users]);
    }


    public function details(ServerRequestInterface $request, array $args)
    {
        $id = $args['id'];

        // Busca a construção pelo ID
        $construction = $this->construction_model->where('id', $id)->first();

        if (!$construction) {
            return Render::render('errors/404', ["message" => "Construção não encontrada"]);
        }

        // Renderiza a view correta
        return Render::render('Construction/Details', ["construction" => $construction]);
    }

    public function listByClient(ServerRequestInterface $request, array $args)
    {
        $clientId = $args['client_id'] ?? null;

        if (!$clientId) {
            return new JsonResponse(["message" => "ID do cliente não informado", "status" => 400]);
        }

        // Busca todas as construções do cliente
        $constructions = $this->construction_model->where('user_id', $clientId)->get();

        if ($constructions->isEmpty()) {
            return new JsonResponse(["message" => "Nenhuma construção encontrada para este cliente", "status" => 404]);
        }

        return new JsonResponse(["constructions" => $constructions, "status" => 200]);
    }
}
