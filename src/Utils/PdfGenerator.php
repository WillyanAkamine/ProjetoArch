<?php

namespace App\Utils;

use App\Models\Construction;
use Dompdf\Dompdf;
use Laminas\Diactoros\Response;

class PdfGenerator
{
    public static function download(Construction $construction, string $filename): Response
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml(self::renderConstructionReport($construction));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $response = new Response();
        $response->getBody()->write($output);

        return $response
            ->withHeader('Content-Type', 'application/pdf')
            ->withHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public static function renderConstructionReport(Construction $construction): string
    {
        $schedules = $construction->schedules ?? [];
        $notes = $construction->notes ?? [];
        $budgets = $construction->budgets ?? [];
        $costs = $construction->costs ?? [];

        $scheduleRows = '';
        foreach ($schedules as $schedule) {
            $scheduleRows .= '<tr>' .
                '<td>' . htmlspecialchars($schedule->description) . '</td>' .
                '<td>' . htmlspecialchars($schedule->progress) . '%</td>' .
                '<td>' . htmlspecialchars($schedule->status) . '</td>' .
                '<td>' . htmlspecialchars($schedule->start_date) . '</td>' .
                '<td>' . htmlspecialchars($schedule->end_date ?? '-') . '</td>' .
                '</tr>';
        }

        $noteRows = '';
        foreach ($notes as $note) {
            $noteRows .= '<tr>' .
                '<td>' . htmlspecialchars($note->description) . '</td>' .
                '<td>' . htmlspecialchars($note->created_at ?? '-') . '</td>' .
                '<td>' . htmlspecialchars($note->pdf?->name ?? '-') . '</td>' .
                '</tr>';
        }

        $budgetRows = '';
        foreach ($budgets as $budget) {
            $budgetRows .= '<tr>' .
                '<td>' . htmlspecialchars($budget->title) . '</td>' .
                '<td>' . number_format(floatval($budget->value), 2, ',', '.') . '</td>' .
                '<td>' . htmlspecialchars($budget->status) . '</td>' .
                '</tr>';
        }

        $costRows = '';
        foreach ($costs as $cost) {
            $costRows .= '<tr>' .
                '<td>' . htmlspecialchars($cost->created_at) . '</td>' .
                '<td>' . number_format($cost->labor, 2, ',', '.') . '</td>' .
                '<td>' . number_format($cost->equip, 2, ',', '.') . '</td>' .
                '<td>' . number_format($cost->third, 2, ',', '.') . '</td>' .
                '<td>' . number_format($cost->adm, 2, ',', '.') . '</td>' .
                '</tr>';
        }

        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Relatório da Obra</title><style>' .
            'body { font-family: Arial, sans-serif; font-size: 12px; }' .
            'table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }' .
            'th, td { border: 1px solid #ddd; padding: 8px; }' .
            'th { background: #f7f7f7; }' .
            '.header { margin-bottom: 20px; }' .
            '.section-title { font-size: 16px; margin: 16px 0 8px; }' .
            '</style></head><body>' .
            '<div class="header"><h1>Relatório da Obra</h1>' .
            '<p><strong>Obra:</strong> ' . htmlspecialchars($construction->title) . '</p>' .
            '<p><strong>Endereço:</strong> ' . htmlspecialchars($construction->address) . ', ' . htmlspecialchars($construction->neighborhood) . ', ' . htmlspecialchars($construction->city) . ' / ' . htmlspecialchars($construction->state) . '</p>' .
            '<p><strong>Progresso geral:</strong> ' . htmlspecialchars($construction->progress) . '%</p></div>' .
            '<div class="section-title">Cronograma</div>' .
            '<table><thead><tr><th>Descrição</th><th>Progresso</th><th>Status</th><th>Início</th><th>Término</th></tr></thead><tbody>' .
            $scheduleRows . '</tbody></table>' .
            '<div class="section-title">Notas / Diálogo da obra</div>' .
            '<table><thead><tr><th>Descrição</th><th>Data</th><th>Arquivo</th></tr></thead><tbody>' .
            $noteRows . '</tbody></table>' .
            '<div class="section-title">Orçamentos</div>' .
            '<table><thead><tr><th>Título</th><th>Valor</th><th>Status</th></tr></thead><tbody>' .
            $budgetRows . '</tbody></table>' .
            '<div class="section-title">Custos registrados</div>' .
            '<table><thead><tr><th>Data</th><th>Mão de obra</th><th>Equipamentos</th><th>Terceiros</th><th>ADM</th></tr></thead><tbody>' .
            $costRows . '</tbody></table>' .
            '</body></html>';

        return $html;
    }
}
