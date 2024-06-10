<?php

namespace App\Controllers;

use App\Models\Notes;
use App\Models\PDF;
use App\Utils\File;
use App\Utils\Render;
use Psr\Http\Message\ServerRequestInterface;

class NotesController {
    private Notes $notes_model;

    public function __construct() 
    {
        $this->notes_model = new Notes();
    }

    public function __invoke() {
        $documents = PDF::where('client_id', $_SESSION['user']['id'])->get();
        return Render::render('Notes', ['documents' => $documents]);
    }

    public function store(ServerRequestInterface $request) {
        File::upload($request->getUploadedFiles(), 'pdf', 'Notes');

        $form_data = $request->getParsedBody();
        
        $inserted = $this->notes_model->insert($form_data);
        
        if(!$inserted) {
            return ["message" => "Ocorreu um erro interno", "statusCode" => 400];
        }

        return ["message" => "Nota criada com sucesso", "statusCode" => 201];
    }
}