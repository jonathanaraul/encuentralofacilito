<?php

namespace Project\UserBundle\Form\Filtros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LinksBlogsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        -> add('name', 'text', array('label'=> 'Nombre','required' => true))  
        -> add('url', 'text', array('label' => 'Url','required' => false))
        -> add('urles', 'text', array('label' =>'urles','required' => false))
        -> add('website', 'text', array('label' => 'Website','required' => false))

        -> add('save', 'submit',array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-info')))
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
        return 'links_blogs_filtro';
    }
}