<?php

namespace Project\UserBundle\Form\Filtros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrackingSiteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        //-> add('trackSite', 'text', array('label' => 'Titulo','required' => false)) 
        //-> add('bookie', 'integer', array('label' => 'Bookie','required' => false))     
        -> add('clickTime', 'datetime', array(
          'label'  => 'Fecha',
          'widget' => 'single_text',
          'format' => 'yyyy',
           'required' => false,
          ))   
        -> add('save', 'submit',array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-info')))
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\TrackingSite'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tracking_site_filtro';
    }
}