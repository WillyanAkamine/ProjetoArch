<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use League\Plates\Engine;

class BudgetController {
    private $templates;

    public function __construct(){
        $this->templates = new Engine(__DIR__.'/../../views');
    }

    public function __invoke(ServerRequestInterface $request) {
        return new HtmlResponse(
            $this->templates->render('Budget', [
                 'user' => $_SESSION["user"] ?? []
            ])
        );
    }
}