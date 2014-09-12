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
use Project\UserBundle\Entity\Pronostico;

class ParserPronosticoController extends Controller {

const NOMBRE_CLASE = 'Pronostico';
const NOMBRE_RUTA = 'pronostico';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_list');
		$form = null;		
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o WHERE o.estado = 0 order by o.id DESC";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination0 = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 10);

		$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o WHERE o.estado = 1 order by o.id DESC";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination1 = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 10);

		$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o WHERE o.estado = 2 order by o.id DESC";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination2 = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 10);

		$array = array('pagination0'=> $pagination0,'pagination1'=> $pagination1, 'pagination2'=> $pagination2, 'url'=> $url);

		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':list.html.twig', $array);
	}

	public function createAction(Request $request) {

		$array = array('accion' => 'nuevo');
		$array['url'] = $this-> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_create');
		$array['data'] = new Pronostico();

		return self::procesar($array, $request, $this);
	}

	public function editAction($id, Request $request) {

        $array = array('accion'=> 'edicion');
		$array['url'] = $this-> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_edit', array('id' => $id));
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

        	return $class-> redirect($class-> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_list'));
        }

		$dql = "SELECT o FROM ProjectUserBundle:Imagen o ";
		$query = $em -> createQuery($dql);

		$paginator = $class -> get('knp_paginator');
		$pagination = $paginator -> paginate($query, $class -> getRequest() -> query -> get('page', 1), 30);

		$array['pagination'] = $pagination;

		$array['form'] = $form-> createView();
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;

		return $class-> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':new-edit.html.twig', $array);
	}
}
