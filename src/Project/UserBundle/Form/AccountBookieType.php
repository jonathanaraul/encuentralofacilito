<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountBookieType extends AbstractType
{

  protected $arraySelects;

  public function __construct( $arraySelects)
  {
     $this->arraySelects = $arraySelects;
  }

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder

        -> add('userId', 'choice', array(
            'choices' => $this->arraySelects[0],
            'label' => 'Usuario',
            'required' => true, 
            ))
        -> add('bookie', 'choice', array(
            'choices' => $this->arraySelects[1],
            'label' => 'Bookie',
            'required' => true, 
            ))     
        -> add('account', 'text', array('label' => 'Cuenta','required' => true))
        -> add('depositado', 'number', array('label' => 'Despositado','required' => true))
        -> add('dineroActual', 'number', array('label' => 'Dinero Actual','required' => true))
        -> add('bono', 'checkbox', array('label' => 'Bono', 'required' => false, 'attr' => array('class' => 'ace-switch') ))
        -> add('rollover', 'text', array('label' => 'Rollover','required' => true))
        -> add('cantidadBono', 'number', array('label' => 'Cantidad bono','required' => true))
        -> add('ganancias', 'number', array('label' => 'Ganancias','required' => true))
        -> add('statusTime', 'date', array(
          'label'  => 'Fecha',
          'widget' => 'single_text',
          'format' => 'yyyy-MM-dd',
           'required' => false,
          ))   
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
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
        return 'account_bookie';
    }
}