<?php

// src/Project/UserBundle/Form/Type/BackgroundType.php
namespace Project\UserBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PaysafecardExtendedType extends PaysafecardType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      parent::buildForm($builder, $options);

        $builder
        ->add('fechaAcreditacion', 'date', array(
          'label'  => 'Fecha de acreditacion',
          'widget' => 'single_text',
          'format' => 'yyyy-MM-dd',
           'required' => false,
          ))

        ->add('comentarios', 'textarea', array('required' => false,'label'  => 'Comentarios','attr' => array('cols' => '26', 'rows' => '5')))
        -> add('acreditado', 'checkbox', array('label' => 'Acreditado', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('acreditadoReferido', 'checkbox', array('label' => 'Acreditado Referido', 'required' => false, 'attr' => array('class' => 'ace-switch') )) ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Paysafecard',
            ));
    }

    public function getName()
    {
        return 'paysafecardextended';
    }
}