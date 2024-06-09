<?php


namespace App\Utils;

use App\Models\PDF;
use Error;

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
        $time_now = round(microtime(true) * 1000);

        self::createDir(__DIR__ . "/../../storage/{$path_name}");
        self::createDir($uploadDir);        

        if (is_array($pdfFile)) {
            foreach ($pdfFile as $pdf) {
                if ($pdf && $pdf->getError() === UPLOAD_ERR_OK) {
                    $filename = $time_now . $pdf->getClientFilename();
                    $pdf->moveTo("{$uploadDir}/{$filename}");

                    $pdf_model->insert([
                        "name" => $filename
                    ]);
                }
            }

            return;
        }

        if ($pdfFile && $pdfFile->getError() === UPLOAD_ERR_OK) {
            $filename = $time_now . $pdfFile->getClientFilename();
            $pdfFile->moveTo("{$uploadDir}/{$time_now}{$filename}");

            $pdf_model->insert([
                "name" => $filename
            ]);
        }
    }
}
