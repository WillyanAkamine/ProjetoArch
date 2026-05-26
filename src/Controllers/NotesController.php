<?php

namespace App\Controllers;

use App\Models\Construction;
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
        $construction = Construction::where('user_id', $client_id)->first();
        $construction_id = $construction ? $construction->id : null;

        $documents = PDF::where(['user_id' => $client_id, 'category' => 'Notes'])->get();
        $notes = $construction_id ? Notes::with('pdf')->where('construction_id', $construction_id)->orderBy('created_at', 'DESC')->get() : [];

        return Render::render('Notes/Show', [
            "documents" => $documents, 
            "notes" => $notes,
            "client_id" => $client_id,
            "construction_id" => $construction_id
        ]);
    }

    public function store(ServerRequestInterface $request, array $args) {
        $client_id = $args['client_id'];
        $construction = Construction::where('user_id', $client_id)->first();

        if (!$construction) {
            return ["message" => "Construção não encontrada para este cliente", "statusCode" => 404];
        }

        $file = File::upload($request->getUploadedFiles(), 'pdf', 'Notes', $client_id);
        $form_data = $request->getParsedBody();
        $firstFileId = null;
        if (is_array($file) && !empty($file)) {
            $firstFileId = $file[0]->id ?? null;
        } elseif ($file) {
            $firstFileId = $file->id ?? null;
        }

        $noteData = [
            'description' => $form_data['description'] ?? '',
            'construction_id' => $construction->id,
            'pdf_id' => $firstFileId,
        ];

        $inserted = $this->notes_model->create($noteData);
        
        if(!$inserted) {
            return ["message" => "Ocorreu um erro interno", "statusCode" => 400];
        }

        return ["message" => "Nota criada com sucesso", "statusCode" => 201];
    }
}