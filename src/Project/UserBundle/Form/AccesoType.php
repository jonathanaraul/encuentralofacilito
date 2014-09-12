<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccesoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        -> add('nombre', 'text', array('label' => 'Nombre','required' => true))
        -> add('url', 'text', array('label' => 'URL','required' => true))
        -> add('usuario', 'text', array('label' => 'Usuario','required' => true))
        -> add('contrasenia', 'text', array('label' => 'Contraseña','required' => true))
        -> add('published', 'checkbox', array('label' => 'Publicado', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Acceso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acceso';
    }
}
