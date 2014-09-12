<?php

namespace Project\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Util\StringUtils;
use Project\UserBundle\Entity\Usuario;
use Project\UserBundle\Entity\Paysafecard;

class PeticionPinSafecardController extends Controller {

const NOMBRE_CLASE = 'Paysafecard';
const NOMBRE_RUTA = 'peticion_pin_paysafecard';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_'.self::NOMBRE_RUTA.'_list');
		$form = null;		
		$filtros = null;
		$data = new Paysafecard();
		$form = $this -> createFormBuilder($data)
		       -> add('emailUsuario', 'text', array('required' => false)) -> add('nickUsuario', 'text', array('required' => false)) -> add('nick', 'text', array('required' => false)) -> add('email', 'text', array('required' => false)) -> add('ip', 'text', array('required' => false)) -> getForm();


		if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {

				$dql = "SELECT  o FROM ProjectUserBundle:Paysafecard o ";
				$where = false;

				if (!(trim($data -> getEmailUsuario()) == false)) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}
					$dql .= " o.emailUsuario like :emailUsuario ";
				}
				if (!(trim($data -> getNickUsuario()) == false)) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}
					$dql .= " o.nickUsuario like :nickUsuario ";
				}
				if (!(trim($data -> getNick()) == false)) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}
					$dql .= " o.nick like :nick ";
				}
				if (!(trim($data -> getEmail()) == false)) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}
					$dql .= " o.email like :email ";
				}
				if (!(trim($data -> getIp()) == false)) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}
					$dql .= " o.ip like :ip ";
				}

				$dql .= "  ORDER BY o.id asc ";

				$query = $em -> createQuery($dql);

				if (!(trim($data -> getEmailUsuario()) == false)) {
					$query -> setParameter('emailUsuario', '%' . $data -> getEmailUsuario() . '%');
				}
				if (!(trim($data -> getNickUsuario()) == false)) {
					$query -> setParameter('nickUsuario', '%' . $data -> getNickUsuario() . '%');
				}
				if (!(trim($data -> getNick()) == false)) {
					$query -> setParameter('nick', '%' . $data -> getNick() . '%');
				}
				if (!(trim($data -> getEmail()) == false)) {
					$query -> setParameter('email', '%' . $data -> getEmail() . '%');
				}
				if (!(trim($data -> getIp()) == false)) {
					$query -> setParameter('ip', '%' . $data -> getIp() . '%');
				}

			}
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////
		else {
			$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o ORDER BY o.id asc";
			$query = $em -> createQuery($dql);
		}

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 30);

		$array = array('pagination'=> $pagination, 'filtros'=> $filtros, 'url'=> $url);
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
		$array['form'] = $form -> createView();
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':list.html.twig', $array);
	}

	public function editAction($id, Request $request) {

        $array = array('accion'=> 'edicion');
		$array['url'] = $this-> generateUrl('project_back_'.self::NOMBRE_RUTA.'_edit', array('id' => $id));
		$array['id'] = $id;

		$array['data'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:'.self::NOMBRE_CLASE)-> find($id);
		if (!$array['data']) {
			throw $this-> createNotFoundException('La pagina que intenta acceder no existe ');
		}

		return self::procesar($array, $request, $this);
	}

	public static function procesar($array, Request $request, $class) {
			
		$data = $array['data'];
		$em = $class-> getDoctrine()-> getManager();
        $user = $class-> getUser();

		$form = $class -> createForm('paysafecardextended', $data);
		$form  ->add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')));
        $form->handleRequest($request);

        if ($form-> isValid()) {
        // Procesa accion en base de datos
            $data-> setIp($class-> container-> get('request')-> getClientIp());
        	$em-> persist($data);
        	$em-> flush();

        	return $class-> redirect($class-> generateUrl('project_back_'.self::NOMBRE_RUTA.'_list'));
        }

		$array['form'] = $form-> createView();
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;

		return $class-> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':new-edit.html.twig', $array);
	}
}
