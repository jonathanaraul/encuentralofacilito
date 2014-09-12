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

class ParserNoticiaController extends Controller {

const NOMBRE_CLASE = 'Noticia';
const NOMBRE_RUTA = 'noticia';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_list');
		$form = null;		

		$data = new Noticia();
		$form = $this -> createFormBuilder($data)
		-> add('fuente', 'entity', array(
			'class' => 'ProjectUserBundle:Fuente',
			'property' => 'nombre',
			'label' => 'Fuente',
			'required' => false, 
			))
		-> add('acceso', 'entity', array(
			'class' => 'ProjectUserBundle:Acceso',
			'property' => 'nombre',
			'label' => 'Acceso',
			'required' => false, 
			))
		-> add('user', 'entity', array(
			'class' => 'ProjectUserBundle:User',
			'property' => 'name',
			'label' => 'Usuario',
			'required' => false, 
			))
		-> getForm();


            if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {

				$dql0 = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o  WHERE o.estado = 0 ";
				$dql1 = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o  WHERE o.estado = 1 ";
				$dql2 = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o  WHERE o.estado = 2 ";
				$where = true;

				if ($data -> getUser() !=null) {

					if ($where == false) {
						$dql0 .= 'WHERE ';
						$dql1 .= 'WHERE ';
						$dql2 .= 'WHERE ';
						$where = true;
					} else {
						$dql0 .= 'AND ';
						$dql1 .= 'AND ';
					    $dql2 .= 'AND ';
					}
					$dql0 .= " o.user = :user ";
					$dql1 .= " o.user = :user ";
					$dql2 .= " o.user = :user ";
				}

				if ($data -> getAcceso()!=null) {

					if ($where == false) {
						$dql0 .= 'WHERE ';
						$dql1 .= 'WHERE ';
						$dql2 .= 'WHERE ';
						$where = true;
					} else {
						$dql0 .= 'AND ';
						$dql1 .= 'AND ';
					    $dql2 .= 'AND ';
					}
					$dql0 .= " o.acceso = :acceso ";
					$dql1 .= " o.acceso = :acceso ";
					$dql2 .= " o.acceso = :acceso ";
				}

				if ($data -> getFuente()!=null) {

					if ($where == false) {
						$dql0 .= 'WHERE ';
						$dql1 .= 'WHERE ';
						$dql2 .= 'WHERE ';
						$where = true;
					} else {
						$dql0 .= 'AND ';
						$dql1 .= 'AND ';
					    $dql2 .= 'AND ';
					}
					$dql0 .= " o.fuente = :fuente ";
					$dql1 .= " o.fuente = :fuente ";
					$dql2 .= " o.fuente = :fuente ";
				}

                $dql0 .= " order by o.id DESC ";
				$dql1 .= " order by o.id DESC ";
				$dql2 .= " order by o.id DESC ";
				
				$query0 = $em -> createQuery($dql0);
				$query1 = $em -> createQuery($dql1);
				$query2 = $em -> createQuery($dql2);

				if ($data -> getUser() !=null) {
					$query0 -> setParameter('user',  $data -> getUser()->getId() );
					$query1 -> setParameter('user',  $data -> getUser()->getId() );
					$query2 -> setParameter('user',  $data -> getUser()->getId() );
				}
				if ($data -> getAcceso() != null) {
					$query0 -> setParameter('acceso',  $data -> getAcceso()->getId() );
					$query1 -> setParameter('acceso',  $data -> getAcceso()->getId() );
					$query2 -> setParameter('acceso',  $data -> getAcceso()->getId() );
				}
				if ($data -> getFuente() != null) {
					$query0 -> setParameter('fuente',  $data -> getFuente()->getId() );
					$query1 -> setParameter('fuente',  $data -> getFuente()->getId() );
					$query2 -> setParameter('fuente',  $data -> getFuente()->getId() );
				}

			}
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////
		else {
		    $dql0 = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o WHERE o.estado = 0 order by o.id DESC";
		    $query0 = $em -> createQuery($dql0);

		    $dql1 = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o WHERE o.estado = 1 order by o.id DESC";
		    $query1 = $em -> createQuery($dql1);

		    $dql2 = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o WHERE o.estado = 2 order by o.id DESC";
		    $query2 = $em -> createQuery($dql2);
		}

		$paginator = $this -> get('knp_paginator');
		$pagination0 = $paginator-> paginate($query0, $this-> getRequest()-> query-> get('page', 1), 10);

		$paginator = $this -> get('knp_paginator');
		$pagination1 = $paginator-> paginate($query1, $this-> getRequest()-> query-> get('page', 1), 10);

		$paginator = $this -> get('knp_paginator');
		$pagination2 = $paginator-> paginate($query2, $this-> getRequest()-> query-> get('page', 1), 10);

		$array = array('pagination0'=> $pagination0,'pagination1'=> $pagination1, 'pagination2'=> $pagination2, 'url'=> $url);
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
		$array['form'] = $form -> createView();
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':list.html.twig', $array);
	}

	public function createAction(Request $request) {

		$array = array('accion' => 'nuevo');
		$array['url'] = $this-> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_create');
		$array['data'] = new Noticia();

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
        	$data->setUser($user);
        	$em-> persist($data);
        	$em-> flush();
        	$manager = $data->getAcceso()->getNombre();

        	$customerEm = $class->get('doctrine')->getManager($manager);

        	$entity  = $data;

        	$arreglo = array('post_author'=> 1, 
        		             'post_date'=> $entity->getUpdated()->format('Y-m-d H:i:s'), 
        		             'post_date_gmt'=> $entity->getUpdated()->format('Y-m-d H:i:s'), 
        		             'post_content'=> $entity ->getDescripcion(), 
        		             'post_title'=> $entity->getNombre(), 
        		             'post_excerpt'=> '', 
        		             'post_status'=> 'publish',
        		             'comment_status'=> 'open',
        		             'ping_status'=>  'open', 
        		             'post_password'=> '', 
        		             'post_name'=> 'item-'.UtilitiesAPI::getFriendlyName( $entity->getNombre(),$class), 
        		             'to_ping'=> '', 
        		             'pinged'=> '', 
        		             'post_modified'=> $entity->getUpdated()->format('Y-m-d H:i:s'),
        		             'post_modified_gmt'=> $entity->getUpdated()->format('Y-m-d H:i:s'), 
        		             'post_content_filtered'=> '', 
        		             'post_parent'=> 0,
        		             'guid'=> 'http://milcasinos.com/item-'.UtilitiesAPI::getFriendlyName( $entity->getNombre(),$class),  
        		             'menu_order'=> 0, 
        		             'post_type'=> 'post',
        		             'post_mime_type'=> '', 
        		             'comment_count'=> 0);   
            
            if($entity->getFechaPublicacion() != null){

            	$arreglo['post_date'] = $entity->getFechaPublicacion()->format('Y-m-d H:i:s');
            	$arreglo['post_date_gmt'] = $entity->getFechaPublicacion()->format('Y-m-d H:i:s');
            	$arreglo['post_modified'] = $entity->getFechaPublicacion()->format('Y-m-d H:i:s');
            	$arreglo['post_modified_gmt'] = $entity->getFechaPublicacion()->format('Y-m-d H:i:s');
            	$arreglo['post_status'] = 'future';

            }

        	$stmt = $customerEm->getConnection()->insert('wp_posts', $arreglo);
        	return $class-> redirect($class-> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_list'));
        }

		$dql = "SELECT o FROM ProjectUserBundle:Imagen o ";
		$query = $em -> createQuery($dql);

		$paginator = $class -> get('knp_paginator');

        $page = $class->getRequest()->query->get ( 'page', 1 ); 
        //La página de los comentarios, si no hay petición(es null) por defecto es 1
        $pagination = $paginator->paginate ( $query, $page, 30); 
        //Los comentarios de la página (10 por página)
        if ($class->getRequest()->query->get ( 'page' ) != null) {
            $arreglo =  array('pagination' => $pagination );
            return $class->render ( 'ProjectBackBundle:Helpers:modal-imagenes-listado.html.twig', $arreglo );
        }

		//$pagination = $paginator -> paginate($query, $class -> getRequest() -> query -> get('page', 1), 30);

		$array['pagination'] = $pagination;

		$array['form'] = $form-> createView();
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;

		return $class-> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':new-edit.html.twig', $array);
	}
	public function imagenTagsAction(Request $request){
		
		$em = $this-> getDoctrine()-> getManager();
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$tags = $post -> get("tags");

		$dql = "SELECT o FROM ProjectUserBundle:Imagen o WHERE o.tags LIKE :tags  ";
		$query = $em -> createQuery($dql);
		$query->setParameter('tags','%'.$tags.'%');

		$paginator = $this -> get('knp_paginator');
        $page = 1;

        $pagination = $paginator->paginate ( $query, $page, 15 ); 
        $array = array();

        $array['pagination'] = $pagination;
        $html = $this -> renderView('ProjectBackBundle:Helpers:modal-imagenes-listado.html.twig',  $array );
       
		$respuesta = new response(json_encode(array('html' => $html)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;

		
	}
	public function borrarPendientesAction(Request $request){
		
		$em = $this-> getDoctrine()-> getManager();
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

        $estado = false;
		$codigo = '';
		$em -> getConnection() -> beginTransaction();
		try {
			$noticias = $em -> getRepository('ProjectUserBundle:'.self::NOMBRE_CLASE ) -> findByEstado(0);
			for ($i=0; $i < count($noticias); $i++) { 
				# code...
				$em -> remove($noticias[$i]);
			    $em -> flush();
			}

			$em -> getConnection() -> commit();
			$estado = true;

		} catch (\Exception $e) {
			$codigo = $e -> getCode();
			//$em->getConnection()->rollback();
			//throw $e;
		}

		$respuesta = new response(json_encode(array('estado' => $estado, 'codigo' => $codigo)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;

		
	}

}
