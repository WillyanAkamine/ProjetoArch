<?php

namespace App\Controllers;

use App\Models\Construction;
use Psr\Http\Message\ServerRequestInterface;

use function App\Utils\render;
use function App\Utils\upload;

class ConstructionController {
    private Construction $construction_model;

    public function __construct() 
    {
        $this->construction_model = new Construction();
    }

    public function __invoke() {
        return render('Construction');
    }

    public function store(ServerRequestInterface $request) {
        upload($request->getUploadedFiles(), 'pdf', 'Construction');

        $form_data = $request->getParsedBody();
        
        $inserted = $this->construction_model->insert($form_data);
        
        if(!$inserted) {
            return ["message" => "Ocorreu um erro interno", "statusCode" => 400];
        }

        return ["message" => "Construção criada com sucesso", "statusCode" => 201];
    }
}