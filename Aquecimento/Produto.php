<?php

require 'Categoria.php';

class Produto {
    
    private $nome;
    private $descricao;
    private $preco;
    private $categoria;
    
    function __construct($nome, $descricao, $preco, $categoria) {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->categoria = $categoria;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getPreco() {
        return $this->preco;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

    function setCategoria(Categoria $categoria) {
        $this->categoria = $categoria;
    }
    
}

