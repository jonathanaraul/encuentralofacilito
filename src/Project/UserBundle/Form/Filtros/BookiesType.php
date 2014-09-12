<?php

namespace Project\UserBundle\Form\Filtros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookiesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        -> add('nombre', 'text', array('label' => 'Nombre','required' => false))
        -> add('url', 'text', array('label' => 'URL','required' => false))
        -> add('patrocinador', 'choice', array(
            'choices'   => array( -1 =>'',0 => 'No', 1 => 'Si'),
            'label' => 'Patrocinador',
            'required'  => true,
            )) 
        -> add('licenciaEsp', 'choice', array(
            'choices'   => array( -1 =>'',0 => 'No', 1 => 'Si'),
            'label' => 'Licencia España',
            'required'  => true,
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
            'data_class' => 'Project\UserBundle\Entity\Bookies'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bookies_filtro';
    }
}