<?php

namespace App\Controllers;

use App\Models\Construction;
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
  private $client_id;
  private $construction_id;

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
    $this->client_id = $args['client_id'];  
    $construction = Construction::where('user_id', $this->client_id)->first();
    $this->construction_id = $construction ? $construction->id : null;

    $documents = PDF::where(['user_id' => $this->client_id, 'category' => 'Cost'])->get();

    return Render::render('Cost/Show', [
      'documents' => $documents, 
      'last_cost' => $this->getLastCost(),
      'total' => $this->calcCost(),
      "client_id" => $this->client_id
    ]);
  }


  private function getCosts()
  {
    if (!$this->construction_id) {
      return [];
    }

    $costs = $this->cost_model->orderBy('created_at', 'DESC')->where('construction_id', $this->construction_id)->get();

    return $costs ?: [];
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

    return [
      'labor' => number_format($total['labor'], 2, ',', '.'),
      'equip' => number_format($total['equip'], 2, ',', '.'),
      'third' => number_format($total['third'], 2, ',', '.'),
      'adm' => number_format($total['adm'], 2, ',', '.'),
      'total' => number_format($total['total'], 2, ',', '.')
    ];
  }

  private function getLastCost()
  {
    if (!$this->construction_id) {
      return [
        'date' => null,
        'labor' => 0,
        'equip' => 0,
        'third' => 0,
        'adm' => 0,
      ];
    }

    $last_cost = $this->cost_model->where('construction_id', $this->construction_id)
      ->orderBy('created_at', 'DESC')
      ->first();

    if (!$last_cost) {
      return [
        'date' => null,
        'labor' => 0,
        'equip' => 0,
        'third' => 0,
        'adm' => 0,
      ];
    }

    return [
      'date' => $last_cost['created_at'],
      'labor' => number_format($last_cost['labor'], 2, ',', '.'),
      'equip' => number_format($last_cost['equip'], 2, ',', '.'),
      'third' => number_format($last_cost['third'], 2, ',', '.'),
      'adm' => number_format($last_cost['adm'], 2, ',', '.'),
    ];
  }

  public function store(ServerRequestInterface $request, array $args)
  {
    $clientId = $args['client_id'];
    $construction = Construction::where('user_id', $clientId)->first();

    if (!$construction) {
      return ["message" => "Construção não encontrada para este cliente."];
    }

    File::upload($request->getUploadedFiles(), 'pdf', 'Cost', $clientId);
    $data = $request->getParsedBody();
    $data['construction_id'] = $construction->id;

    $inserted = $this->cost_model->create($data);

    if (!$inserted) {
      return ["message" => "Erro ao salvar o custo da obra."];
    }

    return ["message" => "Sucesso ao salvar o relatorio de custo da obra!"];
  }
}
