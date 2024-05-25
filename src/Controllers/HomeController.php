<?php

namespace App\Controllers;


use Psr\Http\Message\ServerRequestInterface;
use League\Plates\Engine;

class HomeController
{
    private $templates;
    
    public function __construct(){
        $this->templates = new Engine(__DIR__.'/../../views');
    }

    public function __invoke(ServerRequestInterface $request) {
        return new \Laminas\Diactoros\Response\HtmlResponse(
            $this->templates->render('Home', [
                 'user' => $_SESSION["user"] ?? []
            ])
        );
    }
}
