<?php

namespace Project\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Project\UserBundle\Entity\Usuario;
use Project\UserBundle\Entity\Noticia;
use Project\UserBundle\Entity\Pronostico;
use Project\UserBundle\Entity\Imagen;
use Project\UserBundle\Entity\Fuente;
use Project\UserBundle\Entity\FuenteTipo;

class DefaultController extends Controller {

	protected function getUploadRootDir($class) {
		// the absolute directory path where uploaded
		// documents should be saved
		return $class -> container -> getParameter('kernel.root_dir') . '/../web/' . $class -> getUploadDir();
	}

	protected function getUploadDir() {
		$directorio = 'images';
		return 'uploads/' . $directorio;
	}


	public function indexAction(Request $request) {

		$user = $this -> getUser();
		if ($user == null)
			return $this -> redirect($this -> generateUrl('fos_user_security_login'));

		$em = $this -> getDoctrine() -> getManager();

		$firstArray = array();

		$firstArray['usuariosRegistrados'] = $em -> getRepository('ProjectUserBundle:User') -> getAllLength();

		/*$firstArray['backgrounds'] = $em->getRepository('ProjectUserBundle:Background')
		 ->getAllLength();

		 $firstArray['pages'] = $em->getRepository('ProjectUserBundle:Page')
		 ->getAllLength();

		 $firstArray['terminosBuscados'] = $em->getRepository('ProjectUserBundle:Search')
		 ->getAllLength();

		 $firstArray['terminos'] = $em->getRepository('ProjectUserBundle:Search')
		 ->getDistinctRankingAll();

		 for ($i=0; $i < count($firstArray['terminos']); $i++) {
		 $firstArray['terminos'][$i]['color'] = DefaultController::randColor($this);
		 }
		 */
		$url = $this -> generateUrl('project_back_homepage');

		$locale = UtilitiesAPI::getLocale($this);
		$form = null;
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:User o ";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 30);

		$secondArray = array('pagination' => $pagination, 'filtros' => $filtros, 'url' => $url);

		$array = array_merge($firstArray, $secondArray);

		return $this -> render('ProjectBackBundle:Default:index.html.twig', $array);
	}

	public function deleteAction() {

		$em = $this -> getDoctrine() -> getManager();

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
		$id = $post -> get("objeto");
		$tipo = $post -> get("tipo");
		// Procesa accion en base de datos
		$estado = false;
		$codigo = '';
		$em -> getConnection() -> beginTransaction();
		try {
			$object = $em -> getRepository('ProjectUserBundle:' . $tipo) -> find($id);
			$em -> remove($object);
			$em -> flush();
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

	public function statusAction() {

		$em = $this -> getDoctrine() -> getManager();
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
		$id = $post -> get("objeto");
		$tipo = $post -> get("tipo");
		$tarea = intval($post -> get("tarea"));

		// Procesa accion en base de datos
		$object = $em -> getRepository('ProjectUserBundle:' . $tipo) -> find($id);
		$object -> setPublished($tarea);
		$em -> flush();

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function setHomeAction() {

		$em = $this -> getDoctrine() -> getManager();
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
		$id = $post -> get("objeto");
		$tipo = $post -> get("tipo");
		$tarea = intval($post -> get("tarea"));

		// Procesa accion en base de datos
		$object = $em -> getRepository('ProjectUserBundle:' . $tipo) -> find($id);
		$object -> setHome($tarea);
		$em -> flush();

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public static function promover($rol, $class) {

		$userManager = $class -> container -> get('fos_user.user_manager');
		$user = $class -> getUser();
		$user -> addRole($rol);
		$userManager -> updateUser($user);

	}

	public static function randColor($this) {
		return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
	}

}
