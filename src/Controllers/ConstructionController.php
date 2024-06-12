<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Construction;
use App\Models\PDF;
use App\Utils\File;
use App\Utils\Render;
use Psr\Http\Message\ServerRequestInterface;

class ConstructionController {
    private Construction $construction_model;

    public function __construct() 
    {
        $this->construction_model = new Construction();
    }

    public function __invoke() {
        $users = User::where('role_id', 2)->get();
        return Render::render('Construction/Index', ["users" => $users]);
    }

    public function show($request, array $args) {     
        $client_id = $args['client_id'];   
        $documents = PDF::where(['user_id' => $client_id, 'category' => 'Construction'])->get();

        return Render::render('Construction/Show', [
            "documents" => $documents, 
            "client_id" => $client_id
        ]);
    }

    public function store(ServerRequestInterface $request, array $args) {
        File::upload($request->getUploadedFiles(), 'pdf', 'Construction', $args['client_id']);

        $form_data = $request->getParsedBody();
        
        $inserted = $this->construction_model->insert($form_data);
        
        if(!$inserted) {
            return ["message" => "Ocorreu um erro interno", "statusCode" => 400];
        }

        return ["message" => "Relatorio de obra criado com sucesso!", "statusCode" => 201];
    }
}