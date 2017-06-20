<?php

namespace PokedexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of IndexController
 *
 * @author Jhony
 */
class IndexController extends Controller {
    
   function indexAction() {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('Index/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
   }
    
}
