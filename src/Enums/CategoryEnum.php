<?php

namespace App\Enums;

enum CategoryEnum: string {
    case Fundacao = 'Fundacao';
    case Alvenaria = 'Alvenaria';
    case Eletrica = 'Eletrica';
    case Hidraulica = 'Hidraulica';
    case Cobertura = 'Cobertura';
    case Outros = 'Outros';

}