<?php

namespace App\Controllers;

use App\Models\Construction;
use App\Utils\PdfGenerator;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ReportController
{
    public function constructionReport(ServerRequestInterface $request, array $args)
    {
        $construction = Construction::with(['schedules', 'notes.pdf', 'budgets', 'costs'])
            ->find($args['id']);

        if (!$construction) {
            return new JsonResponse(["message" => "Construção não encontrada", "status" => 404], 404);
        }

        return PdfGenerator::download($construction, 'relatorio-obra-' . $construction->id . '.pdf');
    }
}
