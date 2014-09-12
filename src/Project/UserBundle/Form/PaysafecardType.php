<?php

// src/Project/UserBundle/Form/Type/BackgroundType.php
namespace Project\UserBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PaysafecardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        -> add('bookies', 'entity', array(
            'class' => 'ProjectUserBundle:Bookies',
            'property' => 'nombre',
            'label'  => 'Casa de Apuestas *',
            'attr' => array('class' => 'selectorpay'),
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
            ->where('u.licenciaEsp = :licenciaEsp','u.patrocinador = :patrocinador')        
            ->setParameter('licenciaEsp', 1)
            ->setParameter('patrocinador', 1)
            ->orderBy('u.nombre', 'ASC');
            },
            ))
        ->add('nick', 'text', array('required' => true,'label'  => 'Nick de la casa *'))
        ->add('email', 'text', array('required' => true,'label'  => 'Correo electronico *'))
        ->add('desposito', 'number', array('required' => true,'label'  => 'Cantidad depositada *'))
        ->add('fechaRegistro', 'date', array(
          'label'  => 'Fecha de registro *',
          'widget' => 'single_text',
          'format' => 'yyyy-MM-dd',
          ))
        ->add('fechaDeposito', 'date', array(
          'label'  => 'Fecha de depósito',
          'widget' => 'single_text',
          'format' => 'yyyy-MM-dd',
           'required' => false,
          ))
        ->add('nickUsuario', 'text', array('required' => false,'label'  => 'Nick del usuario que te refiere'))
        ->add('emailUsuario', 'text', array('required' => false,'label'  => 'Mail de usuario que te refiere'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Paysafecard',
            ));
    }

    public function getName()
    {
        return 'paysafecard';
    }
}