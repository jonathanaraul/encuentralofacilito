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

class VotacionesForoController extends Controller {

const NOMBRE_CLASE = 'VotacionesForo';
const NOMBRE_RUTA = 'votaciones_foro';

	public function indexAction(Request $request) {
        
        $array = array( );

		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':index.html.twig', $array);
	}

	public function recalcularAction(Request $request) {
        
		//$em = $this -> getDoctrine() -> getManager();
		$em = $this->get('doctrine')->getManager('foro');

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		$arreglo = self::recalcularProceso($em);

		$htmlCabecera = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cabecera.html.twig' );
		$htmlCuerpo = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cuerpo.html.twig', array('cuerpo'=>$arreglo) );

		$respuesta = new response(json_encode(array('htmlCabecera' => $htmlCabecera,'htmlCuerpo'=>$htmlCuerpo)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
		
	}

	public function eliminarVotosMesAction(Request $request) {
        
        $array = array( );
		//$em = $this -> getDoctrine() -> getManager();
		$em = $this->get('doctrine')->getManager('foro');

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
	    $usuario = $post -> get("usuario");
	    $mes = $post -> get("mes");
	    $anio = $post -> get("anio");

	    $sql = "DELETE from threadrate where MONTH(created_at) = :mes and YEAR(created_at) = :anio and userid in (select userid from user where username = :usuario )";

	    $stmt = $em->getConnection()->prepare($sql);
	    $stmt->bindValue('mes', $mes);
	    $stmt->bindValue('anio', $anio);
	    $stmt->bindValue('usuario', $usuario);
	    $stmt->execute();


		$arreglo = self::recalcularProceso($em);

		$htmlCabecera = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cabecera.html.twig' );
		$htmlCuerpo = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cuerpo.html.twig', array('cuerpo'=>$arreglo) );

		$respuesta = new response(json_encode(array('htmlCabecera' => $htmlCabecera,'htmlCuerpo'=>$htmlCuerpo)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
		

	}
	public function recalcularProceso($em){

		$sql ="SELECT * from threadrate order by threadid desc";

		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		$threadidActual = "";
		$sumatorioVotos = 0;
		$totalVotos = 0;
		$mediaVotos = 0;
		//echo "<span style='color:green;font-size:20px;font-weight:bold;'>Votos recalculados</span><br/>";
		$arreglo = array();
		$i=0;
		$j=0;
		
        foreach ($result as $key => $value) {
        	# code...
			$threadid = $value["threadid"];
			$voto = $value["vote"];	
			
			if($threadidActual != $threadid && $threadidActual != ""){
				// He cambiado de thread, actualizo lo que tengo hasta ahora

				$sql ="UPDATE thread set votenum = :totalVotos , votetotal = :sumatorioVotos where threadid = :threadidActual";

				$stmt = $em->getConnection()->prepare($sql);
				$stmt->bindValue('totalVotos', $totalVotos);
				$stmt->bindValue('sumatorioVotos', $sumatorioVotos);
				$stmt->bindValue('threadidActual', $threadidActual);
				$stmt->execute();

				//echo "HILO: ". $threadidActual . " votacion calculada: ". $mediaVotos . "</br>";
				$arreglo[$i][0]= $threadidActual;
				$arreglo[$i][1]= $mediaVotos;
				
				// Update			
				$totalVotos = 0;
				$mediaVotos = 0;
				$sumatorioVotos = 0;
				$i++;
			}
		
			$threadidActual = $threadid;
			$totalVotos++;
			$sumatorioVotos = $sumatorioVotos + $voto;
			$mediaVotos = $sumatorioVotos/$totalVotos;
        }

        return $arreglo;
	}
}