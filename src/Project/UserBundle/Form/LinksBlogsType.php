<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LinksBlogsType extends AbstractType
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
        -> add('name', 'text', array('label'=> 'Nombre','required' => true))  
        -> add('url', 'text', array('label' => 'Url','required' => true))
        -> add('urles', 'text', array('label' =>'Urles','required' => true))
        //-> add('website', 'text', array('label' => 'Website','required' => true))
        -> add('website', 'choice', array(
            'choices' => $this->arraySelects[0],
            'label' => 'Website',
            'required' => true, 
            ))
        -> add('bookieId', 'choice', array(
            'choices' => $this->arraySelects[1],
            'label' => 'Bookie',
            'required' => true, 
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
            'data_class' => 'Project\UserBundle\Entity\LinksBlogs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'links_blogs';
    }
}