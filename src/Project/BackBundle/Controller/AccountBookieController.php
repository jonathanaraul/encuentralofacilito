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

use Project\UserBundle\Entity\AccountBookie;
use Project\UserBundle\Form\AccountBookieType;

class AccountBookieController extends Controller {

const NOMBRE_CLASE = 'AccountBookie';
const NOMBRE_RUTA = 'account_bookie';

	public function listAction(Request $request) {

		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_'.self::NOMBRE_RUTA.'_list');	

		$data = new AccountBookie();		
		$form = $this-> createForm(self::NOMBRE_RUTA.'_filtro', $data);
	

		if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {
				$filtro = new Filtro(self::NOMBRE_CLASE,$em);
				$filtro->setDQLInicial();
				$filtro->setDataInteger('userId',$data -> getUserId());
				$filtro->setDataInteger('bookie',$data -> getBookie());
			    $filtro->setDataTexto('account',$data -> getAccount());
			//	$filtro->setDataBoolean('depositado',$data -> getDepositado());
			//	$filtro->setDataBoolean('dineroActual',$data -> getDineroActual());
			//	$filtro->setDataBoolean('bono',$data -> getBono());
			//	$filtro->setDataTexto('rollover',$data -> getRollover());
			//	$filtro->setDataBoolean('cantidadBono',$data -> getCantidadBono());
			//	$filtro->setDataBoolean('ganancias',$data -> getGanancias());
				$filtro->setOrder();
				$filtro->setQuery();
				$filtro->setParametroInteger('userId',$data -> getUserId());
				$filtro->setParametroInteger('bookie',$data -> getBookie());
			    $filtro->setParametroTexto('account',$data -> getAccount());
			//	$filtro->setParametroBoolean('depositado',$data -> getDepositado());
			//	$filtro->setParametroBoolean('dineroActual',$data -> getDineroActual());
			//	$filtro->setParametroBoolean('bono',$data -> getBono());
			//	$filtro->setParametroTexto('rollover',$data -> getRollover());
			//	$filtro->setParametroBoolean('cantidadBono',$data -> getCantidadBono());
			//	$filtro->setParametroBoolean('ganancias',$data -> getGanancias());
				$query = $filtro->getQuery();

			}
		}
		else {
			$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o  ";
			$query = $em -> createQuery($dql);
		}

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 30);
	
		$array = array('pagination'=> $pagination,'url'=> $url);
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
	    $array['form'] = $form -> createView();
	    $array['usuarios'] = self::extraerUsuarios($em);
		$array['bookies'] = self::extraerBookies($em);

		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':list.html.twig', $array);
	}

	public function createAction(Request $request) {

		$array = array('accion' => 'nuevo');
		$array['url'] = $this-> generateUrl('project_back_'.self::NOMBRE_RUTA.'_create');
		$array['data'] = new AccountBookie();

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
    public static function extraerUsuarios($em){

         $sql = "SELECT u.usuario_id, u.usuario
		        FROM usuarios u WHERE u.usuario != ''
		        order by u.usuario ASC";		        
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
		$user = $stmt->fetchAll();

		$selectUser = array();

		for ($i=0; $i < count($user); $i++) { 
			# code...
		    $selectUser[$user[$i]['usuario_id']] = $user[$i]['usuario'];
		}

		return $selectUser;
    }

    public static function extraerBookies($em){

         $sql = "SELECT b.id, b.nombre
		        FROM bookies b WHERE b.nombre != ''
		        order by b.nombre ASC";		        
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
		$bookie = $stmt->fetchAll();

		$selectBookies = array();

		for ($i=0; $i < count($bookie); $i++) { 
			# code...
            $selectBookies[$bookie[$i]['id']] =  $bookie[$i]['nombre'];
		}

		return $selectBookies;
    }

	public static function procesar($array, Request $request, $class) {
			
		$data = $array['data'];
		$em = $class-> getDoctrine()-> getManager();
        $user = $class-> getUser();
       ///////////////////////////////////////////////

        $selectUser = self::extraerUsuarios($em);
        $selectBookies = self::extraerBookies($em);

       ////////////////////////////////////////////////

		$form = $class-> createForm(new AccountBookieType(array($selectUser,$selectBookies)), $data);		

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