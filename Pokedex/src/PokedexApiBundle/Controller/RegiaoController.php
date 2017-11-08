<?php

namespace PokedexApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of RegiaoController
 *
 * @author jhony
 */
class RegiaoController extends Controller {
    
    /**
     * @Route("/regioes")
     * @return tipos
     */
    function listarAction() {
        $tipos = $this->getDoctrine()->getRepository('PokedexBundle:Regiao')->findAll();
        $json = array_map(function($r) {
            return [
                'id' => $r->getId(), 
                'nome' => $r->getNome(), 
                'clima' => $r->getClima()
            ];
        }, $tipos);
        return new JsonResponse($json, 200, ['Access-Control-Allow-Origin' => '*']);
    }
    
}
