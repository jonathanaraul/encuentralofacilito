<?php

// src/Project/UserBundle/Form/Type/BackgroundType.php
namespace Project\UserBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PaySafecardBookiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        -> add('bookies', 'entity', array(
            'class' => 'ProjectUserBundle:Bookies',
            'property' => 'nombre',
            'label'  => 'Casa de Apuestas *',
            'attr' => array('class' => 'selectorpay'),
            'multiple' => true,
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
            ->where('u.licenciaEsp = :licenciaEsp')                
            ->setParameter('licenciaEsp', 1)
                ->orderBy('u.nombre', 'ASC');
            },
            ))
        ->add('nombre', 'text', array('required' => true,'label'  => 'Nombre *'))
        ->add('email', 'text', array('required' => true,'label'  => 'Correo electronico *'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Paysafecardbookies',
            ));
    }

    public function getName()
    {
        return 'paysafecardbookies';
    }
}