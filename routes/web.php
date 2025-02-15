<?php

use App\Middlewares\AuthMiddleware;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ResponseFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use Laminas\Diactoros\ServerRequestFactory;
use League\Route\Http\Exception\NotFoundException;

$request = ServerRequestFactory::fromGlobals(
  $_SERVER,
  $_GET,
  $_POST,
  $_COOKIE,
  $_FILES
);

$router = new Router;

$router->map('GET', '/', 'App\Controllers\HomeController');
$router->map('GET', '/login', 'App\Controllers\AuthController');
$router->map('POST', '/login', 'App\Controllers\AuthController::login');
$router->map('GET', '/logout', 'App\Controllers\AuthController::logout');

$router->map('GET', '/pdf/{dir}/{filename}', function ($request, array $args) {
  $filename = $args['filename'];
  $dir = $args['dir'];
  //FIXME: Get params user id 
  $user_id = $_SESSION["user"]['id'];
  $path = __DIR__ . "/../storage/{$dir}/{$user_id}/{$filename}";

  if (file_exists($path)) {
      $response = new Response();
      $response->getBody()->write(file_get_contents($path));
      return $response
          ->withHeader('Content-Type', 'application/pdf')
          ->withHeader('Content-Disposition', 'inline; filename="' . basename($path) . '"');
  }

  throw new NotFoundException('File not found');
});

$router->group('/', function ($router) {
  $router->map('GET', '/obras', 'App\Controllers\ConstructionController::__invoke');
  $router->map('GET', '/obra/create', 'App\Controllers\ConstructionController::create');
  $router->map('POST', '/obra/create', 'App\Controllers\ConstructionController::store'); // Adiciona a rota POST para criação
  $router->map('GET', '/obra/{id}', 'App\Controllers\ConstructionController::show');
  $router->map('GET', '/obra/{id}/details', 'App\Controllers\ConstructionController::details');
  $router->map('GET', '/obra/{id}/edit', 'App\Controllers\ConstructionController::edit');

   // Use POST aqui, mas com o campo _method



  $router->map('GET', '/orcamentos', 'App\Controllers\BudgetController');
  $router->map('GET', '/orcamentos/solicitar', 'App\Controllers\BudgetController::request');
  $router->map('GET', '/orcamentos/ver/{id}', 'App\Controllers\BudgetController::show');
  
  $router->map('GET', '/notas', 'App\Controllers\NotesController');
  $router->map('GET', '/nota/{client_id}', 'App\Controllers\NotesController::show');

  $router->map('GET', '/custos', 'App\Controllers\CostController');
  $router->map('GET', '/custo/{client_id}', 'App\Controllers\CostController::show');

})->middleware(new AuthMiddleware);


//--------------//
//  ROTAS API  //
//------------//

$responseFactory = new ResponseFactory;
$strategyJSON = new League\Route\Strategy\JsonStrategy($responseFactory);

$router->group('/api', function ($router) {
  $router->map('GET', '/obra/{id}', 'App\Controllers\ConstructionController::show');
  $router->map('POST', '/obra', 'App\Controllers\ConstructionController::store');
  $router->map('POST', '/obra/{id}', 'App\Controllers\ConstructionController::update');
  $router->map('DELETE', '/obra/{id}', 'App\Controllers\ConstructionController::delete');
  $router->map('POST', '/obra/{id}/update', 'App\Controllers\ConstructionController::update'); // Use POST aqui, mas com o campo _method
  

  $router->map('POST', '/notas/{client_id}', 'App\Controllers\NotesController::store');
  $router->map('POST', '/custo/{client_id}', 'App\Controllers\CostController::store');
  
  $router->map('GET', '/orcamentos', 'App\Controllers\BudgetController');
  $router->map('GET', '/orcamentos/solicitar', 'App\Controllers\BudgetController::request');
  $router->map('POST', '/orcamentos/criar', 'App\Controllers\BudgetController::store');
  $router->map('GET', '/orcamentos/ver/{id}', 'App\Controllers\BudgetController::show');
  $router->map('GET', '/orcamentos/editar/{id}', 'App\Controllers\BudgetController::edit');
  $router->map('PUT', '/orcamentos/atualizar/{id}', 'App\Controllers\BudgetController::update');
  $router->map('DELETE', '/orcamentos/deletar/{id}', 'App\Controllers\BudgetController::delete');
})->setStrategy($strategyJSON);


$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
