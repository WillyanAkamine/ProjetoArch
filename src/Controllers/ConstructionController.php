<?php

namespace App\Controllers;

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
        $documents = PDF::where('client_id', $_SESSION['user']['id'])->get();
        return Render::render('Construction', ['documents' => $documents]);
    }

    public function store(ServerRequestInterface $request) {
        File::upload($request->getUploadedFiles(), 'pdf', 'Construction');

        $form_data = $request->getParsedBody();
        
        $inserted = $this->construction_model->insert($form_data);
        
        if(!$inserted) {
            return ["message" => "Ocorreu um erro interno", "statusCode" => 400];
        }

        return ["message" => "Construção criada com sucesso", "statusCode" => 201];
    }
}