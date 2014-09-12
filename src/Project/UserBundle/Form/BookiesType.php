<?php

namespace Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookiesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        -> add('file', 'file', array('label'=> 'Logo','required' => false))  
        //-> add('logo', 'text', array('label' => 'Logo','required' => true))
        -> add('nombre', 'text', array('label' => 'Nombre','required' => true))
        -> add('logoGrande', 'textarea', array('label' => 'Logo Grande','required' => true))
        
        -> add('nombreCodificado', 'text', array('label' =>'Nombre Codificado','required' => true))
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
        -> add('bono', 'text', array('label' => 'Bono','required' => true))
        -> add('maximo', 'text', array('label' => 'Maximo','required' => true))
        -> add('condiciones', 'text', array('label' => 'Condiciones','required' => true))
        -> add('depositoMinimo', 'text', array('label' => 'Deposito Minimo','required' => true))
        -> add('apuestaMinima', 'text', array('label' => 'Apuesta Minima','required' => true))
        -> add('apuestasLive', 'checkbox', array('label' => 'Apuestas Live', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('email', 'text', array('label' => 'Email','required' => true))
        -> add('liveChat', 'checkbox', array('label' => 'Live Chat', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('telefono', 'text', array('label' => 'Telefono','required' => true))
        -> add('url', 'text', array('label' => 'URL','required' => true))
        -> add('valoracion', 'number', array('label' => 'Valoracion','required' => true))
        -> add('fiabilidad', 'number', array('label' => 'Fiabilidad','required' => true))
        -> add('cuotas', 'number', array('label' => 'Cuotas','required' => true))
        -> add('usabilidad', 'number', array('label' => 'Usabilidad','required' => true))
        -> add('atencionCliente', 'number', array('label' => 'Atencion Cliente','required' => true))
        -> add('pagos', 'number', array('label' => 'Pagos','required' => true))
        -> add('ranking', 'number', array('label' => 'Ranking','required' => true))
        -> add('patrocinador', 'checkbox', array('label' => 'Patrocinador', 'required' => false, 'attr' => array('class' => 'ace-switch') ))
        -> add('ordenCasas', 'checkbox', array('label' => 'Orden Casas', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('licenciaEsp', 'checkbox', array('label' => 'Licencia España', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('save', 'submit',array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-info')))
        -> getForm();
        

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Bookies'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bookies';
    }
}