<?php

namespace App\Utils;

use App\Models\PDF;

abstract class File
{

    private static function createDir($directoryPath){
        if(!is_dir($directoryPath)){
            mkdir($directoryPath, 0755, true);
        }

        return;
    }

    static function upload($uploadedFiles, string $form_field, string $path_name)
    {
        $pdf_model = new PDF();
        $pdfFile = $uploadedFiles[$form_field] ?? null;
        $uploadDir = __DIR__ . "/../../storage/{$path_name}/{$_SESSION['user']['id']}";
        $time_now = round(microtime(true));

        self::createDir(__DIR__ . "/../../storage/{$path_name}");
        self::createDir($uploadDir);        

        if (is_array($pdfFile)) {
            foreach ($pdfFile as $pdf) {
                if ($pdf && $pdf->getError() === UPLOAD_ERR_OK) {
                    $filename = Formater::kebab($time_now . $pdf->getClientFilename());
                    $pdf->moveTo("{$uploadDir}/{$filename}");

                    $pdf_model->insert([
                        "name" => $filename,
                        "client_id" => $_SESSION['user']['id']
                    ]);
                }
            }

            return;
        }

        if ($pdfFile && $pdfFile->getError() === UPLOAD_ERR_OK) {
            $filename = Formater::kebab($time_now . $pdfFile->getClientFilename());
            $pdfFile->moveTo("{$uploadDir}/{$filename}");

            $pdf_model->insert([
                "name" => $filename,
                "client_id" => $_SESSION['user']['id']
            ]);
        }
    }
}
