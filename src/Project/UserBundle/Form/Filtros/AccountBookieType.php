<?php

namespace Project\UserBundle\Form\Filtros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountBookieType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        -> add('userId', 'integer', array('label' => 'Usuario','required' => false))
        -> add('bookie', 'integer', array('label' => 'Bookie','required' => false))
        -> add('account', 'text', array('label' => 'Cuenta','required' => false))
          //-> add('depositado', 'number', array('label' => 'Despositado','required' => false))
        //-> add('dineroActual', 'number', array('label' => 'Dinero Actual','required' => false))
        //-> add('bono', 'choice', array(
          //  'choices'   => array( -1 =>'',0 => 'No', 1 => 'Si'),
          //  'label' => 'Bono',
          //  'required'  => true,
           // ))  
        //-> add('rollover', 'text', array('label' => 'Rollover','required' => false))
        //-> add('cantidadBono', 'number', array('label' => 'Cantidad bono','required' => false))
        //-> add('ganancias', 'number', array('label' => 'Ganancias','required' => false))
       
        -> add('save', 'submit',array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-info')))
        -> getForm();

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\AccountBookie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'account_bookie_filtro';
    }
}

