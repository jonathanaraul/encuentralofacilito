<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImagenType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array('label' => 'Nombre','required' => true, 'attr' => array('class' => 'span6')))
            ->add('descripcion', 'textarea', array('label' => 'Descripcion','required' => true, 'attr' => array('class' => 'span6')))             
            ->add('file', 'file', array('label'=> 'Imagen','required' => false))  
            ->add('tags', 'text', array('label' => 'Etiquetas','required' => true))
            ->add('published', 'checkbox', array('label' => 'Publicado', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
            ->add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
  
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Imagen'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'imagen';
    }
}
