<?php
// src/Acme/SearchBundle/EventListener/SearchIndexer.php
namespace Project\UserBundle\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Project\UserBundle\Entity\Paysafecard;
use Project\UserBundle\Entity\Fuente;
use Project\UserBundle\Entity\Noticia;
use Project\BackBundle\Controller\UtilitiesAPI;
use Project\UserBundle\Entity\Paysafecardbookies;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;

class EnviadorCorreos
{
	protected $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
    public function postUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager('milcasinos');
        if ($entity instanceof Noticia) {
           // echo'Itento actualizar una noticia con el estado'.$entity->getEstado();exit;

            if($entity->getEstado()==2){


            }

        }
    }
	public function postPersist (LifecycleEventArgs $args)
	{
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        $templating = $this->container->get('templating');
        $mailer = $this->container->get('mailer');

        if ($entity instanceof Paysafecard) {

        	$message = \Swift_Message::newInstance()
        	->setSubject('Petición paysafecard desde todoapuestas')
        	->setFrom('promos@todoapuestas.org')
        	->setTo($entity->getEmail())
        	->setContentType("text/html")
        	->setBody(
        		$templating->render('ProjectFrontBundle:Paysafecard:registro-usuario.html.twig',array('object' => $entity))
        		     );
        	$mailer ->send($message);
            
            if(!is_null($entity->getEmailUsuario())){
            $message = \Swift_Message::newInstance()
            ->setSubject('Petición paysafecard desde todoapuestas')
            ->setFrom('promos@todoapuestas.org')
            ->setTo($entity->getEmailUsuario())
            ->setContentType("text/html")
            ->setBody(
                $templating->render('ProjectFrontBundle:Paysafecard:registro-referido.html.twig',array('object' => $entity))
                     );
            $mailer ->send($message);

            }

            $message = \Swift_Message::newInstance()
            ->setSubject('Petición paysafecard desde todoapuestas')
            ->setFrom($entity->getEmailUsuario())
            ->setTo('promos@todoapuestas.org')
            ->setContentType("text/html")
            ->setBody(
                $templating->render('ProjectFrontBundle:Paysafecard:registro-administrador.html.twig',array('object' => $entity))
                     );
            $mailer ->send($message);

        }
        else if ($entity instanceof Paysafecardbookies) {

            $message = \Swift_Message::newInstance()
            ->setSubject('Registro en casas de apuestas')
            ->setFrom('promos@todoapuestas.org')
            ->setTo($entity->getEmail())
            ->setContentType("text/html")
            ->setBody(
                $templating->render('ProjectFrontBundle:Paysafecardbookies:registro-usuario.html.twig',array('object' => $entity))
                     );
            $mailer ->send($message);
            
            $message = \Swift_Message::newInstance()
            ->setSubject('Registro en casas de apuestas')
            ->setFrom($entity->getEmail())
            ->setTo('promos@todoapuestas.org')
            ->setContentType("text/html")
            ->setBody(
                $templating->render('ProjectFrontBundle:Paysafecardbookies:registro-administrador.html.twig',array('object' => $entity))
                     );
            $mailer ->send($message);

        }
        else if ($entity instanceof Fuente) {

            if($entity->getRss() != null){
                $data = simplexml_load_string(file_get_contents());

                foreach( $data->channel->item as $noticia){ 

                    $articulo= $em-> getRepository('ProjectUserBundle:Noticia')-> findByNombre($noticia->title);

                    if (!$articulo) {
                        $object = new Noticia();
                        $object->setNombre($noticia->title);
                        $object->setDescripcion($noticia->description);
                        $em-> persist($object);
                        $em-> flush();
                    }
                }            
            }
        }
    }
}