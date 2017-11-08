<?php

namespace PokedexApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TipoController extends Controller{    
    
    /**
     * @Route("/tipos")
     * @return tipos
     */
    function listarAction() {
        $tipos = $this->getDoctrine()->getRepository('PokedexBundle:Tipo')->findAll();
        $json = array_map(function($t) {
            return [
                'id' => $t->getId(), 
                'nome' => $t->getNome(), 
                'descricao' => $t->getDescricao()
            ];
        }, $tipos);
        return new JsonResponse($json, 200, ['Access-Control-Allow-Origin' => '*']);
    }
        
}
