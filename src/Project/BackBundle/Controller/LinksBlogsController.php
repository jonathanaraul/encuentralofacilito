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

use Project\UserBundle\Entity\LinksBlogs;
use Project\UserBundle\Form\LinksBlogsType;

class LinksBlogsController extends Controller {

const NOMBRE_CLASE = 'LinksBlogs';
const NOMBRE_RUTA = 'links_blogs';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_'.self::NOMBRE_RUTA.'_list');	

		$data = new LinksBlogs();		
		$form = $this-> createForm(self::NOMBRE_RUTA.'_filtro', $data);

		if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {
				$filtro = new Filtro(self::NOMBRE_CLASE,$em);
				$filtro->setDQLInicial();
				$filtro->setDataTexto('name',$data -> getName());
				$filtro->setDataTexto('url',$data -> getUrl());
				$filtro->setDataTexto('urles',$data -> getUrles());
				$filtro->setDataTexto('website',$data -> getWebsite());

				$filtro->setOrder();
				$filtro->setQuery();
				$filtro->setParametroTexto('name',$data -> getName());
				$filtro->setParametroTexto('url',$data -> getUrl());
				$filtro->setParametroTexto('urles',$data -> getUrles());
				$filtro->setParametroTexto('website',$data -> getWebsite());
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
		$array['url'] = $this-> generateUrl('project_back_'.self::NOMBRE_RUTA.'_create');
		$array['data'] = new LinksBlogs();

		return self::procesar($array, $request, $this);
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
        
        //EN CASO DE REGISTROS RELACIONADOS PREPARAR UN ARRAY PARA LOS SELECTS
        $webs = $class-> getDoctrine()-> getRepository('ProjectUserBundle:TrackedWebs')-> findAll();
        $selectWebs = array();
        for ($i=0; $i < count($webs); $i++) { 
        	$selectWebs[$webs[$i]->getName()] = $webs[$i]->getName();
        }
        $bookies = $class-> getDoctrine()-> getRepository('ProjectUserBundle:Bookies')-> findAll();
        $selectBookies = array();
        for ($i=0; $i < count($bookies); $i++) { 
        	$selectBookies[$bookies[$i]->getId()] = $bookies[$i]->getNombre();
        }
        /////////////////////////////////////////////////////////////////////////

		$form = $class-> createForm(new LinksBlogsType(array($selectWebs,$selectBookies)), $data);

        $form->handleRequest($request);

        if ($form-> isValid()) {
        // Procesa accion en base de datos
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