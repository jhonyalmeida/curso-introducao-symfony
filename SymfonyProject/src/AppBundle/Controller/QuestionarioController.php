<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Resposta;
use AppBundle\Form\QuestionarioType;
use AppBundle\Service\QuestionarioService;

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
    
    function resultadoAction() {
        $respostas = $this->getDoctrine()->getRepository('AppBundle:Resposta')->findAll();
        $counts = [
            'curso' => [0, 0, 0, 0, 0], 
            'programacao' => [0, 0, 0, 0, 0], 
            'php' => [0, 0, 0, 0, 0], 
            'html' => [0, 0, 0, 0, 0]
        ];
        foreach($respostas as $r) {
            $counts['curso'][$r->getNotificacaoCurso() - 1]++;
            $counts['programacao'][$r->getProgramacao() - 1]++;
            $counts['php'][$r->getPhp() - 1]++;
            $counts['html'][$r->getHtml() - 1]++;
        }
        return $this->render('AppBundle:Questionario:resultado.html.twig', [
            'counts' => $counts,
            'respostas' => QuestionarioService::respostas
        ]);
    }
    
}
