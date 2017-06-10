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
    
   function getIndexAction() {
       return $this->render('Index/index.html.twig');
   }
    
}
