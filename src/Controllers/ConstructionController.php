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

class ConstructionController {
    private Construction $construction_model;

    public function __construct() 
    {
        $this->construction_model = new Construction();
    }

    public function __invoke() {
        $constructions = Construction::with('user')->get();

        return Render::render('Construction/Index', ["constructions" => $constructions]);

        return Render::render('Construction/Create', ["constructions" => $constructions]);
    }

    public function show(ServerRequestInterface $request, array $args) {     
        $id = $args['id'];
        
        $construction = $this->construction_model->where('id', $id)->first();

        if(!$construction)
            return new JsonResponse(['message' => "Erro, construção não encontrada", "status" => 404]);

        return new JsonResponse(['construction' => $construction->getAttributes(), "status" => 200]);
    }

    public function store(ServerRequestInterface $request) {
        $data = $request->getParsedBody();

        $construction_validation  = new ConstructionValidation($data);

        if($construction_validation->validation->fails()){
            $errors = $construction_validation->validation->errors();
            return new JsonResponse(["message" => "Erro ao salvar a construção", "status" => 503, "errors" => $errors->toArray()]);
        }

        $construction = $this->construction_model->create($data);

        if(!$construction)
            return new JsonResponse(['message' => "Erro ao salvar a construção", "status" => 400]);
        
         return new JsonResponse(["message" => "Erro, construção não encontrada", "status" => 404]);
        
    }

    public function update(ServerRequestInterface $request, array $args) {
        $data = $request->getParsedBody();
        $construction_validation  = new ConstructionValidation($data);

        if($construction_validation->validation->fails()){
            $errors = $construction_validation->validation->errors();
            return new JsonResponse(["message" => "Erro ao atulizar a construção", "status" => 503, "errors" => $errors->toArray()]);
        }

        $id = $args['id'];

        $construction = $this->construction_model->where('id', $id)->first();

        if(!$construction){
            return new JsonResponse(["message" => "Erro, construção não encontrada", "status" => 404]);
        }

        $updated = $construction->update($data);

        if(!$updated) {
            return new JsonResponse(["message" => "Erro, construção não atualizada", "status" => 400]);
        }

        return new JsonResponse(["message" => "Construção atualizada", "status" => 200]);
    }

    public function delete(ServerRequestInterface $request, array $args) {
        $id = $args['id'];

        $construction = $this->construction_model->where('id', $id)->first();

        if(!$construction)
            return new JsonResponse(["message" => "Erro, construção não encontrada", "status" => 404]);

        $deleted = $construction->delete();

        if(!$deleted)
            return new JsonResponse(["message" => "Erro, construção não deletada", "status" => 400]);

        return new JsonResponse(["message" => "Construção deletada com sucesso", "status" => 200]);
    }

    public function create() {
        $constructions = Construction::with('user')->get();

        return Render::render('Construction/Create', ["constructions" => $constructions]);
    }
    
}