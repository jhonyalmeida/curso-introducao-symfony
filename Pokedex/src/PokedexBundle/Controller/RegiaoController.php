<?php

namespace PokedexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Monolog\Logger;
use PokedexBundle\Entity\Regiao;
use PokedexBundle\Form\RegiaoType;

/**
 * Description of RegiaoController
 *
 * @author jhony
 */
class RegiaoController extends Controller {
    
    function listarAction() {
        $regioes = $this->getDoctrine()->getRepository('PokedexBundle:Regiao')->findAll();
        return $this->render('Regiao/regioes.html.twig', ['regioes' => $regioes]);
    }
    
    function criarAction(Request $request) {
        $regiao = new Regiao();
        $form = $this->createForm(RegiaoType::class, $regiao);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($regiao);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', 'Região criada');
            return $this->redirectToRoute('listarRegioes');
        }
        return $this->render('Regiao/form.html.twig', ['form' => $form->createView()]);
    }
    
    function atualizarAction(Request $request, $id) {
        $regiao = $this->getDoctrine()->getRepository('PokedexBundle:Regiao')->find($id);
        $form = $this->createForm(RegiaoType::class, $regiao);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('listarRegioes');
        }
        return $this->render('Regiao/form.html.twig', [
            'regiao' => $regiao,
            'form' => $form->createView()
        ]);
    }
    
    function deletarAction($id) {
        $regiao = $this->getDoctrine()->getRepository('PokedexBundle:Regiao')->find($id);
        $this->getDoctrine()->getManager()->remove($regiao);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('listarRegioes');
    }
    
}
