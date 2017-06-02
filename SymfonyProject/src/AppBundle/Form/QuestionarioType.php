<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Service\QuestionarioService;

class QuestionarioType extends AbstractType {
    
    function buildForm(FormBuilderInterface $builder, array $options) {
        $respostas = QuestionarioService::respostas;
        $builder
            ->add('notificacaoCurso', ChoiceType::class, [
                'required' => true, 
                'choices' => $respostas['curso']
            ])
            ->add('programacao', ChoiceType::class, [
                'required' => true, 
                'choices' => $respostas['programacao']
            ])
            ->add('php', ChoiceType::class, [
                'required' => true, 
                'choices' => $respostas['php']
            ])
            ->add('html', ChoiceType::class, [
                'required' => true, 
                'choices' => $respostas['html']
            ])
            ->add('btnSalvar', SubmitType::class, ['label' => 'Salvar']);
    }
    
}
