<?php
namespace App\Controllers;

use App\Models\Cost;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use League\Plates\Engine;

class CostController {
    private $templates;
    private $cost_model;

    public function __construct(){
        $this->cost_model = new Cost();
        $this->templates = new Engine(__DIR__.'/../../views');
    }

    public function __invoke(ServerRequestInterface $request) {
        $user = $_SESSION["user"];
        $costs = $this->cost_model->where($user['id'], "client_id")->get();
        return new HtmlResponse(
            $this->templates->render('Cost', [
                 'user' => $user ?? [],
                 'costs' => $costs
            ])
        );
    }

    public function store(ServerRequestInterface $request) {
        $cost = $request->getParsedBody();
        $this->upload($request->getUploadedFiles());
        $this->cost_model->insert($cost);

        return new \Laminas\Diactoros\Response\HtmlResponse(
            $this->templates->render('Cost', [
                 'user' => $_SESSION["user"] ?? []
            ])
        );

    }

    public function upload($uploadedFiles){
        
        $pdfFile = $uploadedFiles['pdf'] ?? null;

        if ($pdfFile && $pdfFile->getError() === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../storage/Cost/';
            $filename = $pdfFile->getClientFilename();
            $pdfFile->moveTo($uploadDir . $filename);
        }
    }

}