<?php

namespace Project\UserBundle\Form\Filtros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListadoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        ->add('created', 'date', array(
            'label'  => 'Fecha',
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'required' => false,
            ))
        ->add('updated', 'date', array(
            'label'  => 'Fecha',
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'required' => false,
            ))
        -> add('user', 'entity', array(
            'class' => 'ProjectUserBundle:User',
            'property' => 'name',
            'label' => 'Usuario',
            'required' => false, 
            ))
        -> add('save', 'submit',array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-info')))
        -> getForm();
        

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Noticia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'listado_filtro';
    }
}
