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

use Project\UserBundle\Entity\Deporte;

class DeporteController extends Controller {

const NOMBRE_CLASE = 'Deporte';
const NOMBRE_RUTA = 'deporte';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_maestros_'.self::NOMBRE_RUTA.'_list');	

		$data = new Deporte();		
		$form = $this-> createForm(self::NOMBRE_RUTA.'_filtro', $data);

		if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {
				$filtro = new Filtro(self::NOMBRE_CLASE,$em);
				$filtro->setDQLInicial();
				$filtro->setDataTexto('nombre',$data -> getNombre());
				$filtro->setOrder();
				$filtro->setQuery();
				$filtro->setParametroTexto('nombre',$data -> getNombre());
				$query = $filtro->getQuery();
			}
		}
		else {
			$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o order by o.id DESC ";
			$query = $em -> createQuery($dql);
		}

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 30);

		$array = array('pagination'=> $pagination,'url'=> $url);
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
	    $array['form'] = $form -> createView();
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':list.html.twig', $array);
	}

	public function createAction(Request $request) {

		$array = array('accion' => 'nuevo');
		$array['url'] = $this-> generateUrl('project_back_maestros_'.self::NOMBRE_RUTA.'_create');
		$array['data'] = new Deporte();

		return self::procesar($array, $request, $this);
	}

	public function editAction($id, Request $request) {

        $array = array('accion'=> 'edicion');
		$array['url'] = $this-> generateUrl('project_back_maestros_'.self::NOMBRE_RUTA.'_edit', array('id' => $id));
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

		$form = $class-> createForm(self::NOMBRE_RUTA, $data);

        $form->handleRequest($request);

        if ($form-> isValid()) {
        // Procesa accion en base de datos
        	$em-> persist($data);
        	$em-> flush();

        	return $class-> redirect($class-> generateUrl('project_back_maestros_'.self::NOMBRE_RUTA.'_list'));
        }

		$array['form'] = $form-> createView();
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;

		return $class-> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':new-edit.html.twig', $array);
	}

}