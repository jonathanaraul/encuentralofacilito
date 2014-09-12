<?php

namespace Project\UserBundle\Form\Filtros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlocksBookiesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        -> add('bono', 'text', array('label' => 'Bono','required' => false))
        -> add('active', 'choice', array(
            'choices'   => array( -1 =>'',0 => 'No', 1 => 'Si'),
            'label' => 'Estatus',
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
            'data_class' => 'Project\UserBundle\Entity\BlocksBookies'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blocks_bookies_filtro';
    }
}