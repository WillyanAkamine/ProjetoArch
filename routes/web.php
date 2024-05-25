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

$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
