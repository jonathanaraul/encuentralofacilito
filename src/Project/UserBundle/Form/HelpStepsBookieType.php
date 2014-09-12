<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HelpStepsBookieType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $bookies = array(2 => '10Bet', 
                         60 => '888Casino', 
                         3 => '888Sport', 
                         39 => 'Bet At Home', 
                         7 => 'Bet24', 
                         56 => 'Bet3000', 
                         8 => 'Bet365');
        $builder
        -> add('titulo', 'text', array('label' => 'Titulo','required' => true))
        -> add('texto', 'ckeditor', array(
            'label' => 'Texto',
            'required' => true,
            'config' => array(
                'toolbar' => array(
                    array(
                        'name'  => 'document',
                        'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                        ),
                    '/',
                    array(
                        'name'  => 'basicstyles',
                        'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                        ),
                    ),
                'uiColor' => '#ffffff',
                ),
            ))
        -> add('file', 'file', array('label' => 'imagenUrl','required' => false, 'attr' => array('accept' => 'image/*')))  
        //-> add('bookieId', 'integer', array('label' => 'bookieId','required' => true))
        -> add('bookieId', 'choice', array(
            'choices' => $bookies,
            'label' => 'bookieId',
            'required' => true, 
            ))
        /*-> add('bookieId', 'choice', array(
            'class' => 'ProjectUserBundle:Bookies',
            'property' => 'nombre',
            'label' => 'bookieId',
            'required' => true, 
            ))  */
        -> add('step', 'choice', array(
            'choices'   => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7'),
            'label' => 'Paso',
            'required'  => false,
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
            'data_class' => 'Project\UserBundle\Entity\HelpStepsBookie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'help_steps_bookie';
    }
}