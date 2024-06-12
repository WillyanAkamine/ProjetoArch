<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\Render;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthController {
  
  public function __invoke() {  
      return Render::render('Login');
  }

  public function login(ServerRequestInterface $request) {
    $login_info = $request->getParsedBody();

    $user = new User();

    $cliente = $user->where([
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