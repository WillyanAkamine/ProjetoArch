<?php

namespace App\Controllers;

use App\Models\Budget;
use App\Utils\Email;
use App\Utils\File;
use App\Utils\Render;
use League\Route\Http\Exception\BadRequestException;
use Psr\Http\Message\ServerRequestInterface;

class BudgetController
{
    private Budget $budget;
    private $user;
    public function __construct()
    {
        $this->budget = new Budget();
        $this->user = $_SESSION['user'];
    }
    public function __invoke()
    {
        if ($this->user['role_id'] == 1)
            $budgets = $this->budget->all();
        else
            $budgets = $this->budget->where('user_id', $this->user['id'])->get();

        return Render::render('Budget/Index', ['budgets' => $budgets]);
    }

    public function send()
    {
        $host = 'smtp.example.com';
        $username = 'seu-usuario@example.com';
        $password = 'sua-senha';
        $port = 587;
        $smtpSecure = 'tls';

        $email = new Email($host, $username, $password, $port, $smtpSecure);

        $from = $_SESSION['user']['email'];
        $to = 'willyan.rxp@hotmail.com';
        $subject = 'Assunto do E-mail';
        $body = '<h1>Conteúdo do E-mail em HTML</h1><p>Esta é uma mensagem de teste.</p>';

        if ($email->send($from, $to, $subject, $body)) {
            echo 'E-mail enviado com sucesso!';
        } else {
            echo 'Erro ao enviar o e-mail.';
        }
    }

    public function request()
    {
        return Render::render('Budget/Budget');
    }

    public function show(ServerRequestInterface $request, $args)
    {
        $budget_id = $args['id']; 
        $budget = $this->budget->where('id', $budget_id)->with(['pdf', 'client'])->firstOrFail();

        if ($this->user['role_id'] == 1)
            return Render::render('Budget/Admin/Show', ["budget" => $budget]);
        else
            return Render::render('Budget/Client/Show', ["budget" => $budget]);
    }

    public function sendBudget(ServerRequestInterface $request, $args)
    {
        $budget_id = $args['id'];
    
        $budget = $this->budget->where('id', $budget_id)->firstOrFail();
        $file = File::upload($request->getUploadedFiles(), 'pdf', 'Budget', $budget->user_id);
      
        if(!$file)
            throw new BadRequestException('Falha ao salvar arquivo!');

        $budget->pdf_id = $file['id'];
        $budget->saveOrFail();

        return ["message" => "Pedido de Orçamento enviado com sucesso!", "statusCode" => 200];        
    }

    public function store(ServerRequestInterface $request, $args)
    {

        $inserted = $this->budget->insert([...$request->getParsedBody(), "user_id" => $args['user_id']]);

        if (!$inserted) {
            return ["message" => "Ocorreu um erro interno", "statusCode" => 400];
        }

        return ["message" => "Pedido de Orçamento salvo com sucesso!", "statusCode" => 201];
    }

    public function accepted(ServerRequestInterface $request, $args){
        $budget_id = $args['id'];
        $data = $request->getParsedBody();

        $budget = $this->budget->where('id', $budget_id)->firstOrFail();

        $budget->accepted = $data['accepted'];
        $budget->saveOrFail();

        return ["message" => "Pedido de Orçamento enviado com sucesso!", "statusCode" => 200];
    }
}
