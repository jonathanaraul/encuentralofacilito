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
use Project\UserBundle\Entity\Paysafecardbookies;
use Project\UserBundle\Entity\Paybookiesvalues;
use Project\UserBundle\Entity\Bookies;

class RegistroCasasApuestasController extends Controller {

const NOMBRE_CLASE = 'Paysafecardbookies';
const NOMBRE_CLASE2 = 'Paybookiesvalues';
const NOMBRE_RUTA = 'registro_casas_apuestas';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_'.self::NOMBRE_RUTA.'_list');

		$data = new Paysafecardbookies();
		$form = $this -> createFormBuilder($data) -> add('nombre', 'text', array('required' => false)) -> add('email', 'text', array('required' => false)) -> getForm();

		if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {

				$dql = "SELECT  o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o ";
				$where = false;

				if (!(trim($data -> getNombre()) == false)) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}
					$dql .= " o.nombre like :nombre ";
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

				$dql .= "  ORDER BY o.id asc ";
				
				$query = $em -> createQuery($dql);

				if (!(trim($data -> getNombre()) == false)) {
					$query -> setParameter('nombre', '%' . $data -> getNombre() . '%');
				}
				if (!(trim($data -> getEmail()) == false)) {
					$query -> setParameter('email', '%' . $data -> getEmail() . '%');
				}

			}
		}
        else {
			$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o ORDER BY o.id asc";
			$query = $em -> createQuery($dql);
		}

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 30);

		$array = array('pagination'=> $pagination, 'url'=> $url);
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;

		$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE2." o ";
		$query = $em -> createQuery($dql);

		$values = $query -> getResult();
		$arreglo = array();
		for ($i = 0; $i < count($values); $i++) {
			# code...
			$arreglo[$values[$i] -> getPaysafecardbookies() -> getId()][$values[$i] -> getBookies() -> getId()] = $values[$i] -> getNombre();
		}
		$array['values'] = $arreglo;
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

		$form = $class -> createFormBuilder($data) 
		-> add('bookies', 'entity', array('class' => 'ProjectUserBundle:Bookies', 'property' => 'nombre', 'label' => 'Casa de Apuestas *', 'attr' => array('class' => 'selectorpay'), 'multiple' => true, 'query_builder' => function(EntityRepository $er) {
			return $er -> createQueryBuilder('u') -> where('u.licenciaEsp = :licenciaEsp') -> setParameter('licenciaEsp', 1) -> orderBy('u.nombre', 'ASC');
		}, )) 
		-> add('nombre', 'text', array('required' => true, 'label' => 'Nombre *')) 
		-> add('email', 'text', array('required' => true, 'label' => 'Correo electronico *')) 
		-> add('comentarios', 'textarea', array('required' => false, 'label' => 'Comentarios', 'attr' => array('cols' => '26', 'rows' => '5'))) 
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
		 -> getForm();
		$form -> handleRequest($request);

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

	public function saveBookiesValuesAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$em = $this -> getDoctrine() -> getManager();

		$bookies = intval($post -> get("bookies"));
		$paysafecardbookies = intval($post -> get("paysafecardbookies"));
		$nombre = $post -> get("nombre");

		$paysafecardbookies = $em -> getRepository('ProjectUserBundle:Paysafecardbookies') -> find($paysafecardbookies);
		$bookies = $em -> getRepository('ProjectUserBundle:Bookies') -> find($bookies);

		$data = $em -> getRepository('ProjectUserBundle:Paybookiesvalues') -> findOneBy(array('bookies' => $bookies, 'paysafecardbookies' => $paysafecardbookies));

		if (!$data) {
			$data = new Paybookiesvalues();
			$data -> setBookies($bookies);
			$data -> setPaysafecardbookies($paysafecardbookies);
		}
		$data -> setNombre($nombre);
		$em -> persist($data);
		$em -> flush();

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
}
