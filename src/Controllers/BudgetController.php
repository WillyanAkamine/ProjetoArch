<?php

namespace App\Controllers;

use App\Utils\Render;

class BudgetController {
    public function __invoke() {
        return Render::render('Budget/Index');
    }
}