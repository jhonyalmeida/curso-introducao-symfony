<?php

class Categoria {
    
    private $nome;
    
    function __construct($nome) {
        $this->nome = $nome;
    }

    function getNome() {
        return $this->nome;
    }
    
}

