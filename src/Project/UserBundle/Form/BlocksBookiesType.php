<?php

namespace Project\UserBundle\Form;

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
        -> add('bookieId', 'number', array('label' => 'Bookie','required' => true))
        -> add('trackId', 'number', array('label' => 'Track Pagina Web','required' => true))
        -> add('active', 'checkbox', array('label' => 'Activo', 'required' => false, 'attr' => array('class' => 'ace-switch') ))
        -> add('order', 'number', array('label' => 'Orden','required' => true))        
        -> add('bono', 'text', array('label' => 'Bono','required' => true))
        -> add('urles', 'text', array('label' => 'Urles','required' => true))
        -> add('url', 'text', array('label' => 'URL','required' => true))
        -> add('noDeposit', 'checkbox', array('label' => 'No Deposito', 'required' => false, 'attr' => array('class' => 'ace-switch') ))
        -> add('bonoNoDeposit', 'text', array('label' => 'Bono no Deposito','required' => true))
        -> add('urlNoDeposit', 'text', array('label' => 'URL no Deposito','required' => true))
        -> add('urlesNoDeposit', 'text', array('label' => 'Urles no Deposito','required' => true))
        -> add('bonoNoDeposit', 'text', array('label' => 'Bono no Deposito','required' => true))
        
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
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
        return 'blocks_bookies';
    }
}