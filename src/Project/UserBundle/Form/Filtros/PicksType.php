<?php

namespace Project\UserBundle\Form\Filtros;

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
        -> add('userid', 'integer', array('label' => 'Usuario','required' => false))
        //-> add('evento', 'text', array('label' => 'Evento','required' => false))
        -> add('pronostico', 'text', array('label' => 'Pronostico','required' => false))
        -> add('cuota', 'number', array('label' => 'Cuota','required' => false))
        -> add('stake', 'text', array('label' => 'Stake','required' => false))
        -> add('casa', 'text', array('label' => 'Casa','required' => false))
        //-> add('acertado', 'integer', array('label' => 'Acertado','required' => false))  
        //-> add('unidades', 'number', array('label' => 'Unidades','required' => false))        
        //-> add('deporte', 'integer', array('label' => 'Torneo','required' => false))
        -> add('cantidad', 'number', array('label' => 'Cantidad','required' => false))
        //-> add('pickForoId', 'integer', array('label' => 'Pick Padre','required' => false))
        -> add('save', 'submit',array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-info')))
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
        return 'picks_filtro';
    }
}
