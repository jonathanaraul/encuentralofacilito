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
use Project\UserBundle\Entity\Noticia;

class ParserListadosController extends Controller {

const NOMBRE_CLASE = 'Noticia';
const NOMBRE_RUTA = 'noticia';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_list');	

		$data = new Noticia();		
		$form = $this-> createForm('listado_filtro', $data);

		if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {
				$filtro = new Filtro(self::NOMBRE_CLASE,$em);
				$filtro->setDQLInicial();
				$filtro->setDataObjeto('user',$data -> getUser());
				$filtro->setOrder();
				$filtro->setQuery();
				$filtro->setParametroObjeto('user',$data -> getUser());
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
		
		return $this -> render('ProjectBackBundle:Listado:list.html.twig', $array);
	}

}