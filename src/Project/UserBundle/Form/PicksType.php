<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PicksType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        -> add('userid', 'integer', array('label' => 'Usuario','required' => true))
        -> add('evento', 'text', array('label' => 'Evento','required' => true))
        -> add('pronostico', 'text', array('label' => 'Pronostico','required' => true))
        -> add('fecha', 'date', array(
          'label'  => 'Fecha de publicación',
          'widget' => 'single_text',
          'format' => 'yyyy-MM-dd',
           'required' => false,
          ))  
        -> add('cuota', 'number', array('label' => 'Cuota','required' => true))
        -> add('stake', 'text', array('label' => 'Stake','required' => true))
        -> add('casa', 'text', array('label' => 'Casa','required' => true))
        -> add('acertado', 'integer', array('label' => 'Acertado','required' => true))  
        -> add('pickCreated', 'date', array(
          'label'  => 'Fecha de publicación',
          'widget' => 'single_text',
          'format' => 'yyyy-MM-dd',
           'required' => false,
          ))   
        -> add('unidades', 'number', array('label' => 'Unidades','required' => true))        
        -> add('deporte', 'integer', array('label' => 'Torneo','required' => true))
        -> add('cantidad', 'number', array('label' => 'Cantidad','required' => true))
        -> add('pickForoId', 'integer', array('label' => 'Pick Padre','required' => true))
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Picks'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'picks';
    }
}
