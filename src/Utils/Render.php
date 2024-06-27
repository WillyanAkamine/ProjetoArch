<?php 

namespace App\Utils;

use Laminas\Diactoros\Response\HtmlResponse;
use League\Plates\Engine;

abstract class Render {

    static function render(string $name, array $params = [])  {
        return new HtmlResponse(
            (new Engine(__DIR__ . '/../../views'))
            ->render($name, [
                'user' => $_SESSION['user'] ?? [],
                ...$params
            ])
        );
    }

}