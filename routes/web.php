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
  $router->map('GET', '/obras', 'App\Controllers\ConstructionController');
  $router->map('GET', '/obra/{client_id}', 'App\Controllers\ConstructionController::show');

  $router->map('GET', '/orcamentos', 'App\Controllers\BudgetController');
  
  $router->map('GET', '/notas', 'App\Controllers\NotesController');
  $router->map('GET', '/nota/{client_id}', 'App\Controllers\NotesController::show');

  $router->map('GET', '/custos', 'App\Controllers\CostController');
})->middleware(new AuthMiddleware);


//--------------//
//  ROTAS API  //
//------------//

$responseFactory = new ResponseFactory;
$strategyJSON = new League\Route\Strategy\JsonStrategy($responseFactory);

$router->group('/api', function ($router) {
  $router->map('POST', '/obra/{client_id}', 'App\Controllers\ConstructionController::store');
  $router->map('POST', '/notas/{client_id}', 'App\Controllers\NotesController::store');
  $router->map('POST', '/custo/{client_id}', 'App\Controllers\CostController::store');
})->setStrategy($strategyJSON);


$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
