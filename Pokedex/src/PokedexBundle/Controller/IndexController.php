<?php

namespace PokedexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bridge\Monolog\Logger;

/**
 * Description of IndexController
 *
 * @author Jhony
 */
class IndexController extends Controller {
    
   function indexAction() {
       return $this->render('Index/index.html.twig');
   }
    
}
