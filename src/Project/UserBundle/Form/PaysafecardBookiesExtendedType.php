<?php

// src/Project/UserBundle/Form/Type/BackgroundType.php
namespace Project\UserBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PaysafecardBookiesExtendedType extends PaySafecardBookiesType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      parent::buildForm($builder, $options);

        $builder
        ->add('comentarios', 'textarea', array('required' => true,'label'  => 'Comentarios','attr' => array('cols' => '26', 'rows' => '5')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Paysafecardbookies',
            ));
    }

    public function getName()
    {
        return 'paysafecardextended';
    }
}