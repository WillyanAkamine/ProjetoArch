<?php

namespace App\Validations;

use Rakit\Validation\Validator;

class ConstructionValidation {
    private $rules = [
        'title' => 'required|min:3|max:100',
        'progress' => 'required'
    ];

    private $messages = [
        'title:required' => 'Título é obrigatório',
        'title:min' => 'Título deve conter mínimo 3 letras',
        'title:max' => 'Título deve conter máximo 100 letras',
        'progress:required' => 'Progresso é obrigatório'
    ];

    public $validation;
    
    public function __construct(array $data) {
        $validate = new Validator();

        $this->validation = $validate->make($data, $this->rules, $this->messages);
        
        $this->validation->validate();
    }
}