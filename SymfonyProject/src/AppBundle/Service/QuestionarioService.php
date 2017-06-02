<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

class QuestionarioService {
    
    const respostas = [
        'curso' => [
            'Amigos' => 1,
            'Facebook, LinkedIn ou outra rede social' => 2,
            'Lista de e-mail da Univali' => 3,
            'Site da Univali' => 4,
            'Outro meio' => 5
        ],
        'programacao' => [
            'Nenhuma noção de programação' => 1,
            'Nunca programei pra valer, conheço lógica de programação' => 2,
            'Programo no meu curso superior / técnico / outro' => 3,
            'Trabalho com programação, mas não para web' => 4,
            'Trabalho com programação de sistemas web' => 5
        ],
        'php' => [
            'Nunca usei' => 1,
            'Dei uma brincada de leve, só para conhecer' => 2,
            'Programei nela ocasionalmente' => 3,
            'Programo nela profissionalmente, sem frameworks' => 4,
            'Programo nela profissionalmente, uso frameworks, mas não Symfony' => 5
        ],
        'html' => [
            'Nunca usei' => 1,
            'Dei uma brincada de leve, só para conhecer' => 2,
            'Construi sites simples, apenas para apresentação de conteúdos' => 3,
            'Construi sites mais elaborados, com formulários' => 4,
            'Sou web designer profissional' => 5
        ]
    ];
    
    private $orm;
    
    function __construct(EntityManagerInterface $orm) {
        $this->orm = $orm;
    }
    
    
    
}
