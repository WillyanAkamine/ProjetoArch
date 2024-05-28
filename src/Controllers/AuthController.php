<?php

namespace App\Controllers;


use App\Models\Cliente;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthController {
  private $templates;
    
  public function __construct() {
      $this->templates = new Engine(__DIR__.'/../../views');
  }

  public function __invoke(ServerRequestInterface $request) {
      return new HtmlResponse(
          $this->templates->render('Login', ['title' => 'Login Page'])
      );
  }

  public function login(ServerRequestInterface $request) {
    $login_info = $request->getParsedBody();

    $cliente_model = new Cliente();

    $cliente = $cliente_model->where([
      "name" => $login_info["name"], 
      "password" => $login_info["password"]
    ])->first();
 
    $_SESSION["user"] = $cliente->getAttributes();
      
    return new RedirectResponse('/');
  }

  public function logout(){
    session_unset();
    session_destroy();

    return new RedirectResponse('/');
  }
}