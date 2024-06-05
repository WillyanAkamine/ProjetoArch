<?php

namespace App\Utils;

use App\Models\PDF;
use Laminas\Diactoros\Response\HtmlResponse;
use League\Plates\Engine;

function render(string $name, array $params = [])  {
    return new HtmlResponse(
        (new Engine(__DIR__ . '/../../views'))
        .render($name, [
            'user' => $_SESSION['user'] ?? [],
            [...$params]
        ])
    );
}

function upload($uploadedFiles, string $form_field, string $path_name)
{
    $pdf_model = new PDF();
    $pdfFile = $uploadedFiles[$form_field] ?? null;

    if(is_array($pdfFile)){
        foreach($pdfFile as $pdf){
            if ($pdf && $pdf->getError() === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . "/../../storage/{$path_name}/{$_SESSION['user']['id']}";
                $filename = $pdf->getClientFilename();
                $pdf->moveTo($uploadDir . $filename);

                $pdf_model->insert([
                    "name" => $filename
                ]);
            }
        }

        return;
    }

    if ($pdfFile && $pdfFile->getError() === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . "/../../storage/{$path_name}/{$_SESSION['user']['id']}";
        $filename = $pdfFile->getClientFilename();
        $pdfFile->moveTo($uploadDir . $filename);
    }
}