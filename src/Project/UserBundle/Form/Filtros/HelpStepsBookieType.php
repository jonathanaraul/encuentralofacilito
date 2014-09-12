<?php

namespace Project\UserBundle\Form\Filtros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HelpStepsBookieType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        -> add('titulo', 'text', array('label' => 'Titulo','required' => false))
        -> add('step', 'choice', array(
            'choices'   => array(-1 => '',1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7'),
            'label' => 'Paso',
            'required'  => true,
            ))        
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\HelpStepsBookie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'help_steps_bookie_filtro';
    }
}