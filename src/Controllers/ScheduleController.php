<?php

namespace App\Controllers;

use App\Models\Construction;
use App\Models\Schedule;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ScheduleController
{
    private Schedule $schedule;

    public function __construct()
    {
        $this->schedule = new Schedule();
    }

    public function store(ServerRequestInterface $request, array $args)
    {
        $constructionId = $args['id'] ?? null;
        $construction = Construction::find($constructionId);

        if (!$construction) {
            return new JsonResponse(["message" => "Construção não encontrada", "status" => 404], 404);
        }

        $data = $request->getParsedBody();
        $schedule = $this->schedule->create([
            'description' => $data['description'] ?? '',
            'progress' => $data['progress'] ?? '0',
            'start_date' => $data['start_date'] ?? date('Y-m-d'),
            'end_date' => $data['end_date'] ?: null,
            'status' => $data['status'] ?? 'Inicio',
            'construction_id' => $constructionId,
        ]);

        if (!$schedule) {
            return new JsonResponse(["message" => "Erro ao salvar o cronograma", "status" => 500], 500);
        }

        return new JsonResponse(["message" => "Cronograma salvo com sucesso", "status" => 201, "schedule" => $schedule], 201);
    }
}
