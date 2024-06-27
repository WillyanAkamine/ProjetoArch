<?php

namespace App\Controllers;

use App\Utils\Render;

class HomeController
{
    public function __invoke() {
        return Render::render('Home');
    }
}
