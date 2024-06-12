<?php

namespace App\Controllers;

use App\Models\Cost;
use App\Utils\Render;
use App\Models\PDF;
use App\Models\User;
use App\Utils\File;
use Psr\Http\Message\ServerRequestInterface;

class CostController
{
  private $cost_model;
  private $user;

  public function __construct()
  {
    $this->cost_model = new Cost();
    $this->user = $_SESSION["user"];
  }

  public function __invoke()
  {
    $users = User::where('role_id', 2)->get();
    return Render::render('Cost/Index', ["users" => $users]);
  }

  public function show($request, array $args){
    $client_id = $args['client_id'];  
    $documents = $documents = PDF::where(['user_id' => $client_id, 'category' => 'Cost'])->get();

    return Render::render('Cost/Show', [
      'documents' => $documents, 
      'last_cost' => $this->getLastCost(),
      'total' => $this->calcCost(),
      "client_id" => $client_id
    ]);
  }


  private function getCosts()
  {
    $costs = $this->cost_model->orderBy('date', 'DESC')->where("user_id", $this->user['id'])->get();

    if (!$costs) {
      return [];
    }

    return $costs;
  }

  private function calcCost()
  {
    $costs = $this->getCosts();
    $total = [
      'labor' => 0,
      'equip' => 0,
      'third' => 0,
      'adm' => 0,
      'total' => 0
    ];

    foreach ($costs as $cost) {
      $total['labor'] += $cost->labor;
      $total['equip'] += $cost->equip;
      $total['third'] += $cost->third;
      $total['adm'] += $cost->adm;
      $total['total'] += $cost->labor + $cost->equip + $cost->third + $cost->adm;
    }

    return $total;
  }

  private function getLastCost()
  {
    $last_cost = $this->cost_model->where("user_id", $this->user['id'])
      ->orderBy('date', 'DESC')
      ->first();

    if (!$last_cost) {
      return [
        'date' => null,
        'labor' => 0,
        'equip' => 0,
        'third' => 0,
        'adm' => 0,
        'total' => 0
      ];
    }

    return $last_cost;
  }

  public function store(ServerRequestInterface $request, array $args)
  {
    File::upload($request->getUploadedFiles(), 'pdf', 'Cost', $args['client_id']);
    $inserted = $this->cost_model->insert($request->getParsedBody());

    if (!$inserted) {
      return ["message" => "Erro ao deletar!"];
    }

    return ["message" => "Sucesso ao salvar o relatorio de custo da obra!"];
  }
}
