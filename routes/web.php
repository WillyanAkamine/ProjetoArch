<?php

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

$router->map('GET', '/obra', 'App\Controllers\ConstructionController');
$router->map('POST', '/obra', 'App\Controllers\ConstructionController::store');

$router->map('GET', '/orcamento', 'App\Controllers\BudgetController');

$router->map('GET', '/notas', 'App\Controllers\NotesController');
$router->map('POST','/notas', 'App\Controllers\NotesController::store');

$router->map('GET', '/custo', 'App\Controllers\CostController');
$router->map('POST','/custo', 'App\Controllers\CostController::store');

$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
