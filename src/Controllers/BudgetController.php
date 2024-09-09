<?php

namespace App\Controllers;

use App\Models\Budget;
use App\Models\Materials;
use App\Utils\Email;
use App\Utils\File;
use App\Utils\Render;
use League\Route\Http\Exception\BadRequestException;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class BudgetController
{
    private Budget $budget;
    private $construction;

    public function __construct()
    {
        $this->budget = new Budget();
        $this->construction = $_SESSION['user'];  // Usuário logado
    }

    // Lista orçamentos, dependendo do tipo de usuário (admin ou cliente)
    public function __invoke()
    {
        if ($this->construction['role_id'] == 1) {
            $budgets = $this->budget->all();  // Administrador vê todos os orçamentos
        } else {
            $budgets = $this->budget->where('construction_id', $this->construction['id'])->get();  // Cliente vê apenas seus orçamentos
        }

        return Render::render('Budget/Index', ['budgets' => $budgets]);
    }

    // Exibe o formulário para solicitar um novo orçamento, com a lista de materiais
    public function request()
    {
        $materials = Materials::all();  // Carrega todos os materiais disponíveis
        return Render::render('Budget/Budget', ['materials' => $materials]);  // Passa os materiais para a view
    }

    // Cria um novo orçamento com materiais, etapas e quantidades
    public function store(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $materials = $data['materials'];  // Array de materiais, etapas e quantidades

        // Cria o orçamento
        $budget = $this->budget->create($data);

        if (!$budget) {
            return new JsonResponse(["message" => "Erro ao salvar o orçamento", "status" => 400]);
        }

        // Associa os materiais ao orçamento
        foreach ($materials as $material) {
            $budget->materials()->attach($material['material_id'], [
                'quantity' => $material['quantity'],
                'step' => $material['step']
            ]);
        }

        return new JsonResponse(["message" => "Orçamento criado com sucesso!", "status" => 201]);
    }

    // Exibe um orçamento específico com materiais
    public function show(ServerRequestInterface $request, $args)
    {
        $budget_id = $args['id'];
        $budget = $this->budget->with(['materials'])->where('id', $budget_id)->firstOrFail();

        if ($this->construction['role_id'] == 1) {
            return Render::render('Budget/Admin/Show', ["budget" => $budget]);
        } else {
            return Render::render('Budget/Client/Show', ["budget" => $budget]);
        }
    }

    // Atualiza um orçamento e seus materiais
    public function update(ServerRequestInterface $request, $args)
    {
        $budget_id = $args['id'];
        $data = $request->getParsedBody();
        $materials = $data['materials'];

        $budget = $this->budget->where('id', $budget_id)->firstOrFail();

        // Atualiza o orçamento
        $budget->update($data);

        // Atualiza os materiais associados
        $budget->materials()->detach();  // Remove todas as associações antigas
        foreach ($materials as $material) {
            $budget->materials()->attach($material['material_id'], [
                'quantity' => $material['quantity'],
                'step' => $material['step']
            ]);
        }

        return new JsonResponse(["message" => "Orçamento atualizado com sucesso!", "status" => 200]);
    }

    // Deleta um orçamento
    public function delete(ServerRequestInterface $request, $args)
    {
        $budget_id = $args['id'];

        $budget = $this->budget->where('id', $budget_id)->firstOrFail();

        // Remove as associações com os materiais antes de deletar o orçamento
        $budget->materials()->detach();
        $budget->delete();

        return new JsonResponse(["message" => "Orçamento deletado com sucesso!", "status" => 200]);
    }

    // Envia um orçamento por e-mail
    public function send()
    {
        $host = 'smtp.example.com';
        $username = 'seu-usuario@example.com';
        $password = 'sua-senha';
        $port = 587;
        $smtpSecure = 'tls';

        $email = new Email($host, $username, $password, $port, $smtpSecure);

        $from = $_SESSION['user']['email'];
        $to = 'willyan.rxp@hotmail.com';  // O destinatário pode ser dinâmico
        $subject = 'Assunto do E-mail';
        $body = '<h1>Conteúdo do E-mail em HTML</h1><p>Esta é uma mensagem de teste.</p>';

        if ($email->send($from, $to, $subject, $body)) {
            return new JsonResponse(['message' => 'E-mail enviado com sucesso!', 'status' => 200]);
        } else {
            return new JsonResponse(['message' => 'Erro ao enviar o e-mail.', 'status' => 500]);
        }
    }

    // Envia um orçamento com um arquivo PDF anexado
    public function sendBudget(ServerRequestInterface $request, $args)
    {
        $budget_id = $args['id'];
        $budget = $this->budget->where('id', $budget_id)->firstOrFail();
        
        // Faz upload do arquivo PDF
        $file = File::upload($request->getUploadedFiles(), 'pdf', 'Budget', $budget->user_id);

        if (!$file) {
            throw new BadRequestException('Falha ao salvar o arquivo!');
        }

        $budget->pdf_id = $file['id'];
        $budget->saveOrFail();

        return new JsonResponse(["message" => "Pedido de Orçamento enviado com sucesso!", "status" => 200]);
    }

    // Aceita ou rejeita um orçamento
    public function accepted(ServerRequestInterface $request, $args)
    {
        $budget_id = $args['id'];
        $data = $request->getParsedBody();

        $budget = $this->budget->where('id', $budget_id)->firstOrFail();
        $budget->accepted = $data['accepted'];
        $budget->saveOrFail();

        return new JsonResponse(["message" => "Status do orçamento atualizado com sucesso!", "status" => 200]);
    }
}
