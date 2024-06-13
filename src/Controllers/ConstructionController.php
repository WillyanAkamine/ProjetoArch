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
    public AuthController $auth;

    public function __construct() 
    {
        $this->construction_model = new Construction();
        $this->auth = new AuthController();
    }

    public function __invoke() {

        if($this->auth->getUser()['id'] == 1) {
            $users = User::where('role_id', 2)->get();
        }else{
            $users = User::where('id', $this->auth->getUser()['id'])->get();
        }

        return Render::render('Construction/Index', ["users" => $users]);
    }

    public function show($request, array $args) {     
        $client_id = $args['client_id'];   
        $documents = PDF::where(['user_id' => $client_id, 'category' => 'Construction'])
                    ->with('construction')
                    ->get();

        return Render::render('Construction/Show', [
            "documents" => $documents, 
            "client_id" => $client_id
        ]);
    }

    public function store(ServerRequestInterface $request, array $args) {
        $pdf = File::upload($request->getUploadedFiles(), 'pdf', 'Construction', $args['client_id']);
        
        $construct = $this->construction_model->create([
            ...$request->getParsedBody(),
            'pdf_id' => $pdf->id
        ]);

        
        
        if(!$construct) {
            return ["message" => "Ocorreu um erro interno", "statusCode" => 400];
        }

        return ["message" => "Relatorio de obra criado com sucesso!", "statusCode" => 201];
    }
}