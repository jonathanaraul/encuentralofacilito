<?php

namespace Project\FrontBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Project\UserBundle\Entity\Paysafecard;
use Project\UserBundle\Entity\Paysafecardbookies;

class RegistroCasasApuestasController extends Controller {

	public function indexAction(Request $request) {

		$data = new Paysafecardbookies();
		$form = $this -> createForm('paysafecardbookies', $data);
		$form -> add('save', 'submit', array('label' => 'Enviar', 'attr' => array('class' => 'btn3')));
		$array['form'] = $form -> createView();
		$array['mensaje'] = false;

		$form -> handleRequest($request);

		if ($form -> isValid()) {
			// perform some action, such as saving the task to the database
			$em = $this -> getDoctrine() -> getManager();
			//$data->setDateUpdated(new \DateTime('now'));
			$data -> setIp($this -> container -> get('request') -> getClientIp());
			$em -> persist($data);
			$em -> flush();

			$array['mensaje'] = true;
		}
		return $this -> render('ProjectFrontBundle:Paysafecardbookies:index.html.twig', $array);
	}


}
