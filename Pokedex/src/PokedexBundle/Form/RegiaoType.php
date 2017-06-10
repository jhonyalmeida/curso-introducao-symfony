<?php

namespace PokedexBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PokedexBundle\Entity\Regiao;

/**
 * Description of RegiaoForm
 *
 * @author jhony
 */
class RegiaoType extends AbstractType {
    
    function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nome', null, ['label' => 'Nome', 'required' => true])
                ->add('clima', ChoiceType::class, [
                    'label' => 'Clima',
                    'required' => true,
                    'choices' => Regiao::CLIMAS,
                    'placeholder' => 'Selecione um clima...'
                ])
                ->add('btnSalvar', SubmitType::class, ['label' => 'Salvar']);
    }
    
}
