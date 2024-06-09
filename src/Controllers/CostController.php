<?php

namespace App\Controllers;

use App\Models\Cost;
use App\Utils\Render;
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
    return Render::render(
    'Cost', [
      'last_cost' => $this->getLastCost(),
      'total' => $this->calcCost()
    ]);
  }

  private function getCosts()
  {
    $costs = $this->cost_model->orderBy('date', 'DESC')->where("client_id", $this->user['id'])->get();
    
    if (!$costs){
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
    $last_cost = $this->cost_model->where("client_id", $this->user['id'])
      ->orderBy('date', 'DESC')
      ->first();

    if(!$last_cost){
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

  public function store(ServerRequestInterface $request)
  {
    $this->upload($request->getUploadedFiles());
    $saved = $this->cost_model->insert([...$request->getParsedBody(), "client_id" => $this->user['id']]);

    if(!$saved){
      return ["message" => "Erro ao deletar!"];
    }

     return ["message" => "Sucesso ao savar o custo de obra!"];
  }

  //TODO: USE UTIL UPLOAD CLASS
  public function upload($uploadedFiles)
  {

    $pdfFile = $uploadedFiles['pdf'] ?? null;

    if ($pdfFile && $pdfFile->getError() === UPLOAD_ERR_OK) {
      $uploadDir = __DIR__ . '/../../storage/Cost/' . $this->user['id'];
      $filename = $pdfFile->getClientFilename();
      $pdfFile->moveTo($uploadDir . $filename);
    }
  }
}
