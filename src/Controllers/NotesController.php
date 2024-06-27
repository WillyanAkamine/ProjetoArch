<?php

namespace App\Controllers;

use App\Models\Notes;
use App\Models\PDF;
use App\Models\User;
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
        $users = User::where('role_id', 2)->get();
        return Render::render('Notes/Index', ["users" => $users]);
    }

    public function show($request, array $args) {     
        $client_id = $args['client_id'];   
        $documents = PDF::where(['user_id' => $client_id, 'category' => 'Notes'])->get();

        return Render::render('Notes/Show', [
            "documents" => $documents, 
            "client_id" => $client_id
        ]);
    }

    public function store(ServerRequestInterface $request, array $args) {
        $client_id = $args['client_id'];
        File::upload($request->getUploadedFiles(), 'pdf', 'Notes', $client_id);

        $form_data = $request->getParsedBody();
        
        $inserted = $this->notes_model->insert($form_data);
        
        if(!$inserted) {
            return ["message" => "Ocorreu um erro interno", "statusCode" => 400];
        }

        return ["message" => "Nota criada com sucesso", "statusCode" => 201];
    }
}