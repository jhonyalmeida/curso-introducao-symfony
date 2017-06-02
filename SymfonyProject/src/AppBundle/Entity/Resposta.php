<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "resposta")
 */
class Resposta {
    
    /**
    * @ORM\Id
    * @ORM\Column(type = "integer")
    * @ORM\GeneratedValue
    */
    private $id;
    
    /**
     * @ORM\Column(name = "notificacao_curso", type = "integer", nullable = false)
     */
    private $notificacaoCurso;
    
    /**
     * @ORM\Column(type = "integer", nullable = false)
     */
    private $programacao;
    
    /**
     * @ORM\Column(type = "integer", nullable = false)
     */
    private $php;
    
    /**
     * @ORM\Column(type = "integer", nullable = false)
     */
    private $html;
    
    function getId() {
        return $this->id;
    }

    function getNotificacaoCurso() {
        return $this->notificacaoCurso;
    }

    function getProgramacao() {
        return $this->programacao;
    }

    function getPhp() {
        return $this->php;
    }

    function getHtml() {
        return $this->html;
    }

    function setNotificacaoCurso($notificacaoCurso) {
        $this->notificacaoCurso = $notificacaoCurso;
    }

    function setProgramacao($programacao) {
        $this->programacao = $programacao;
    }

    function setPhp($php) {
        $this->php = $php;
    }

    function setHtml($html) {
        $this->html = $html;
    }
    
}

