<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrackedWebsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        -> add('name', 'text', array('label' => 'Nombre','required' => true))   
        -> add('web', 'text', array('label' => 'Nombre Pagina Web','required' => true))
        -> add('category', 'choice', array(
            'choices'   => array(1 => 'Apuestas', 2 => 'Casinos', 3 => 'Poker', 4 => 'Juegos', 5 => 'Bingo'),
            'required'  => true,
            'label' => 'Tipo'
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
            'data_class' => 'Project\UserBundle\Entity\TrackedWebs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tracked_webs';
    }
}