<?php

namespace App\Controllers;

use App\Models\Cost;
use Psr\Http\Message\ServerRequestInterface;
use function App\Utils\render;

class CostController
{
  private $templates;
  private $cost_model;
  private $user;

  public function __construct()
  {
    $this->cost_model = new Cost();
    $this->user = $_SESSION["user"];
  }

  public function __invoke()
  {
    return render(
    'Cost', [
      'last_cost' => $this->getLastCost()->getAttributes(),
      'total' => $this->calcCost()
    ]);
  }

  private function getCosts()
  {
    return $this->cost_model->orderBy('date', 'DESC')->where("client_id", $this->user['id'])->get();
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
    return $this->cost_model->where("client_id", $this->user['id'])
      ->orderBy('date', 'DESC')
      ->first();
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
