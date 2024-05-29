<?php

use App\Middlewares\AuthMiddleware;
use Laminas\Diactoros\ResponseFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use Laminas\Diactoros\ServerRequestFactory;

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

$router->group('/cliente', function ($router) {
  $router->map('GET', '/obra', 'App\Controllers\ConstructionController');
  $router->map('GET', '/orcamento', 'App\Controllers\BudgetController');
  $router->map('GET', '/notas', 'App\Controllers\NotesController');
  $router->map('GET', '/custo', 'App\Controllers\CostController');
})->middleware(new AuthMiddleware);

//ROTAS API

$responseFactory = new ResponseFactory;
$strategyJSON = new League\Route\Strategy\JsonStrategy($responseFactory);

$router->group('/api', function ($router) {
  $router->map('POST', '/obra', 'App\Controllers\ConstructionController::store');
  $router->map('POST', '/notas', 'App\Controllers\NotesController::store');
  $router->map('POST', '/custo', 'App\Controllers\CostController::store');
})->setStrategy($strategyJSON);


$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
