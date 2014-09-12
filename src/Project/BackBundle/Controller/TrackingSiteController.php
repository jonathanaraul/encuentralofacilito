<?php

namespace Project\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Util\StringUtils;

use Project\UserBundle\Entity\TrackingSite;

class TrackingSiteController extends Controller {

const NOMBRE_CLASE = 'TrackingSite';
const NOMBRE_RUTA = 'tracking_site';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_'.self::NOMBRE_RUTA.'_list');	

		

		if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {
				$filtro = new Filtro(self::NOMBRE_CLASE,$em);
				$filtro->setDQLInicial();
				$filtro->setDataTexto('trackSite',$data -> getTrackSite());
				$filtro->setDataBoolean('bookie',$data -> getBookie());
				$filtro->setOrder();
				$filtro->setQuery();
				$filtro->setParametroTexto('trackSite',$data -> getTrackSite());
				$filtro->setParametroBoolean('bookie',$data -> getBookie());
				$query = $filtro->getQuery();
			}
		}
		/*else {
			$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o  ";
			$query = $em -> createQuery($dql);
		}

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 30);*/

		$pagination = array('getTotalItemCount' => 0 );;
	
		$array = array('pagination'=> $pagination,'url'=> $url);
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;

		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':list.html.twig', $array);
	}

	public function searchAction() {

		$em = $this -> getDoctrine() -> getManager();

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
		$mes = $post -> get("mes");
		$anio = $post -> get("anio");



        $sql ="SELECT distinct(b.nombre) as casa from tracking_site t, bookies b where t.bookie = b.id 
               and monthname(t.click_time) =  :mes and year(t.click_time) =  :anio order by casa";

		$stmt = $em->getConnection()->prepare($sql);
		$stmt->bindValue('mes', $mes);
		$stmt->bindValue('anio', $anio);
		$stmt->execute();
		$cabecera = $stmt->fetchAll();


		$sql = "SELECT t.track_site as track, b.nombre as casa, count(t.track_site) as clicks 
		        FROM tracking_site t, bookies b where t.bookie = b.id and t.track_site <> '' 
		        and monthname(t.click_time) = :mes and  year(t.click_time) =  :anio group by t.track_site, t.bookie 
		        order by track_site, casa";

		$stmt = $em->getConnection()->prepare($sql);
		$stmt->bindValue('mes', $mes);
		$stmt->bindValue('anio', $anio);
		$stmt->execute();
		$track = $stmt->fetchAll();

		$sql = "SELECT * from impressions_track order by track_site";

		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
		$impresiones = $stmt->fetchAll();

		$cuerpo = self::obtenArregloCuerpo($cabecera,$track,$impresiones);
        //var_dump($cuerpo);exit;


		$htmlCabecera = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cabecera.html.twig', array('cabecera'=>$cabecera) );
		$htmlCuerpo = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cuerpo.html.twig', array('cuerpo'=>$cuerpo) );

		//var_dump($cabecera);exit;

		$respuesta = new response(json_encode(array('htmlCabecera' => $htmlCabecera,'htmlCuerpo'=>$htmlCuerpo)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	public function obtenArregloCuerpo($cabecera,$track,$impresiones){
		$cuerpo = array( );
		$i=0;
		foreach ($impresiones as $key => $value) {
			
			$sitio = $value["track_site"];
			$encontrado = false;
			
			foreach ($track as $clave => $valor) {
				if($sitio== $valor["track"]){
					$encontrado = true;
					break;
				}
			}
			if($encontrado===true){
				$cuerpo[$i][0]= $value["track_site"].'('. $value["impressions"].')';
				

				$encontradoClick = false;
                
                $j=1;
				foreach ($cabecera as $cabeceraClave => $cabeceraValor) {
					
					$casa = $cabeceraValor["casa"];
                    
                    $x=0;
					foreach ($track as $trackClave => $trackValor) {
					$x++;
						
                        $cuerpo[$i][$j]= "0";
						if($sitio== $trackValor["track"] && $trackValor["casa"] ==$casa){
							$cuerpo[$i][$j]= $trackValor["clicks"];
							$j++;
							$encontradoClick = true;
							break;
						}
					    if($x == count($track))$j++;
					}
				}
                $i++;
			}
		}

		return $cuerpo;
	}
	public function in_array_field($needle, $needle_field, $haystack, $strict = false) { 
    if ($strict) { 
        foreach ($haystack as $item) 
            if (isset($item->$needle_field) && $item->$needle_field === $needle) 
                return true; 
    } 
    else { 
        foreach ($haystack as $item) 
            if (isset($item->$needle_field) && $item->$needle_field == $needle) 
                return true; 
    } 
    return false; 
    } 


}