<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Resposta;
use AppBundle\Form\QuestionarioType;

class QuestionarioController extends Controller {
    
    function questionarioFormAction(Request $request) {
        $resposta = new Resposta();
        $form = $this->createForm(QuestionarioType::class, $resposta);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($resposta);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('confirmacao_envio');
        }
        return $this->render('AppBundle:Questionario:index.html.twig', ['form' => $form->createView()]);
    }
    
    function confirmacaoEnvioAction() {
        return $this->render('AppBundle:Questionario:confirmacao.html.twig');
    }
    
}
