<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoticiaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        -> add('nombre', 'text', array('label' => 'Nombre','required' => true))
        -> add('video', 'text', array('label' => 'Video','required' => false))
        -> add('descripcion', 'ckeditor', array(
            'label' => 'Descripcion',
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
        -> add('imagen', 'entity', array(
            'class' => 'ProjectUserBundle:Imagen',
            'property' => 'nombre',
            'label' => 'Imagen',
            'required' => true, 
            ))  
        -> add('acceso', 'entity', array(
            'class' => 'ProjectUserBundle:Acceso',
            'property' => 'nombre',
            'label' => 'Blog',
            'required' => true, 
            ))  
        ->add('fechaPublicacion', 'date', array(
          'label'  => 'Fecha de publicación',
          'widget' => 'single_text',
          'format' => 'yyyy-MM-dd',
           'required' => false,
          ))   
           ->add('estado', 'choice', array(
            'choices'   => array(0 => 'Pendiente de redaccion', 1 => 'Pendiente de publicacion', 2 => 'Publicada'),
            'label' => 'Estado',
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
            'data_class' => 'Project\UserBundle\Entity\Noticia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'noticia';
    }
}
