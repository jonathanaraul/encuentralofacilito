<?php

namespace Project\BackBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\EntityRepository;
use Project\UserBundle\Entity\Usuario;
use Project\UserBundle\Entity\Noticia;
use Project\UserBundle\Entity\Pronostico;
use Project\UserBundle\Entity\Imagen;
use Project\UserBundle\Entity\Fuente;
use Project\UserBundle\Entity\FuenteTipo;
use Project\BackBundle\Controller\ParserRutinasController;

class ParserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('projectbackbundle:parser:rastreo')
            ->setDescription('Enviar un email con las matriculas de los cursos')
            ->addArgument('nombre', InputArgument::OPTIONAL, 'Ninguno')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getManager();
        $templating = $this->getContainer()->get('templating');
        $mailer = $this->getContainer()->get('mailer');
        $rutaImagenes =  $this->getContainer() -> getParameter('kernel.root_dir'). '/../web/uploads/images';
        
        $array= ParserRutinasController::rutinasAction($em,$rutaImagenes,$this);
        
        $message = \Swift_Message::newInstance()
        ->setSubject('Parseo de fuentes')
        ->setFrom("promos@todoapuestas.org")
        ->setTo('jonathan.araul@gmail.com')
        ->setContentType("text/html")
        ->setBody(
            $templating->render('ProjectBackBundle:Default:parseo-correo.html.twig',$array)
            );
        $mailer ->send($message);

        $message = \Swift_Message::newInstance()
        ->setSubject('Parseo de fuentes')
        ->setFrom("promos@todoapuestas.org")
        ->setTo('osiris@todomaestrat.com')
        ->setContentType("text/html")
        ->setBody(
            $templating->render('ProjectBackBundle:Default:parseo-correo.html.twig',$array)
            );
        $mailer ->send($message);
        
    }
}