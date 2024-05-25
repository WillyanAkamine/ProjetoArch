<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use League\Plates\Engine;

class ConstructionController {
    private $templates;

    public function __construct(){
        $this->templates = new Engine(__DIR__.'/../../views');
    }

    public function __invoke(ServerRequestInterface $request) {
        return new HtmlResponse(
            $this->templates->render('Construction', [
                 'user' => $_SESSION["user"] ?? []
            ])
        );
    }

    public function upload(ServerRequestInterface $request) {

        $uploadedFiles = $request->getUploadedFiles();


        $pdfFile = $uploadedFiles['pdf'] ?? null;

        if ($pdfFile && $pdfFile->getError() === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../storage/';
            $filename = $pdfFile->getClientFilename();
            $pdfFile->moveTo($uploadDir . $filename);
        }
        return new \Laminas\Diactoros\Response\HtmlResponse(
            $this->templates->render('Construction', [
                 'user' => $_SESSION["user"] ?? []
            ])
        );

    }
}