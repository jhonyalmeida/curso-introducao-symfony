<?php

namespace PokedexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Monolog\Logger;
use PokedexBundle\Entity\Usuario;
use PokedexBundle\Form\UsuarioType;

/**
 * Description of RegiaoController
 *
 * @author jhony
 */
class UsuarioController extends Controller {
    
    function listarAction(Request $request) {
        $usuarios = $this->getDoctrine()->getRepository('PokedexBundle:Usuario')->findAll();
        return $this->render('Usuario/usuarios.html.twig', ['usuarios' => $usuarios]);
    }
    
    function criarAction(Request $request) {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($usuario);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', 'Usuário criado');
            return $this->redirectToRoute('listarUsuarios');
        }
        return $this->render('Usuario/form.html.twig', ['form' => $form->createView()]);
    }
    
    function atualizarAction(Request $request, $id) {
        $usuario = $this->getDoctrine()->getRepository('PokedexBundle:Usuario')->find($id);
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('listarUsuarios');
        }
        return $this->render('Usuario/form.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView()
        ]);
    }
    
    function deletarAction($id) {
        $usuario = $this->getDoctrine()->getRepository('PokedexBundle:Usuario')->find($id);
        $this->getDoctrine()->getManager()->remove($usuario);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('listarUsuarios');
    }
    
}
