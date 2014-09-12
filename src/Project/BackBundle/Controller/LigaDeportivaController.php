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

class LigaDeportivaController extends Controller {

const NOMBRE_CLASE = 'LigaDeportiva';
const NOMBRE_RUTA = 'liga_deportiva';

	public function puntosLDAction(Request $request) {
        
        $array = array( );

		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':puntos-ld.html.twig', $array);
	}

	public function buscarUsuarioAction(Request $request) {
        
        $array = array( );
		$em = $this->get('doctrine')->getManager();

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
	    $usuario = $post -> get("usuario");
	    $mes = $post -> get("mes");
	    $anio = $post -> get("anio");


	    if( $mes == "" || $anio == ""){
	    	$sql = "SELECT e.id as evento_id, e.corregido, e.nombre as evento, p.nombre as pronostico, up.acierto,up.puntos_jugados, p.cuota, up.realizado_en, up.cuota_jugada
	    	FROM usuarios u, usuario_pronosticos up, pronostico p, evento e
	    	where u.usuario = :usuario
	    	and up.usuario_id = u.usuario_id
	    	and up.pronostico_id = p.id
	    	and p.evento_id = e.id 
	    	and month(up.realizado_en) = month(now()) and year(up.realizado_en) = year(now())
	    	order by up.realizado_en asc";

	    	$stmt = $em->getConnection()->prepare($sql);
	    	$stmt->bindValue('usuario', $usuario);
	    	
	    }
	    else{
	    	$sql = "SELECT e.id as evento_id, e.corregido, e.nombre as evento, p.nombre as pronostico, up.acierto,up.puntos_jugados, p.cuota, up.realizado_en, up.cuota_jugada
	    	FROM usuarios u, usuario_pronosticos up, pronostico p, evento e
	    	where u.usuario = :usuario
	    	and up.usuario_id = u.usuario_id
	    	and up.pronostico_id = p.id
	    	and p.evento_id = e.id 
	    	and month(up.realizado_en) = :mes and year(up.realizado_en) = :anio
	    	order by up.realizado_en asc";

	    	$stmt = $em->getConnection()->prepare($sql);
	        $stmt->bindValue('mes', $mes);
	        $stmt->bindValue('anio', $anio);
	    	$stmt->bindValue('usuario', $usuario);
	    	
	    }
	    $stmt->execute();
	    $arreglo = $stmt->fetchAll();

	    //var_dump($arreglo);exit;



	    $sql = "SELECT puntos_extra from usuarios where usuario = :usuario";

	    $stmt = $em->getConnection()->prepare($sql);
	    $stmt->bindValue('usuario', $usuario);
	    $stmt->execute();
	    $puntosUsuario = $stmt->fetchAll();
        
        $puntosUsuario = 100 ;
        if(isset( $puntosUsuario["puntos_extra"]))$puntosUsuario +=  $puntosUsuario["puntos_extra"];	


		$htmlCabecera = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cabecera.html.twig' );
		$htmlCuerpo = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cuerpo.html.twig', array('cuerpo'=>$arreglo,'puntosUsuario'=>$puntosUsuario) );

		$respuesta = new response(json_encode(array('htmlCabecera' => $htmlCabecera,'htmlCuerpo'=>$htmlCuerpo)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
		

	}
	public function correctorLDAction(Request $request) {
        
        $array = array( );
		$em = $this->get('doctrine')->getManager();

        $month = date("m");
        $year = date("Y");

		$helpers = self::correctorLDResults($month,$year,false,$this);

        $array['events'] = $helpers[0];
        //$array['elements'] = $arreglo;
        $array['nombreMes'] = self::nombreMes($month);
        $array['mes'] = $month;
        $array['anio'] = $year;
        $array['options'] = $helpers[1];
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':corrector-ld.html.twig', $array);
	}
	public function correctorLDMesAnteriorAction(Request $request) {
        
        $array = array( );
		$em = $this -> getDoctrine() -> getManager();

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
	    $fecha = $post -> get("fecha");
	    $fecha = explode("-", $fecha);

	    $month =  intval($fecha[0]);
        $year  =  intval($fecha[1]);

        if($month==1){
        	$month = 12;
        	$year = $year - 1;
        }
        else{
        	$month = $month -1;
        }

		$helpers = self::correctorLDResults($month,$year,true,$this);

        $array['events'] = $helpers[0];
        $array['options'] = $helpers[1];

        $htmlCabecera ='';
        $htmlCuerpo ='';
        $htmlError = '';
        $results= false;
        if(count($array['events'])>0){
        	$results= true;
		    $htmlCabecera = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cabecera-corrector-ld.html.twig' );
		    $htmlCuerpo = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':list-element-corrector-ld.html.twig', $array );
        }
        else{
        	$htmlError = $this -> renderView('ProjectBackBundle:Helpers:busqueda-fallida.html.twig' );
        }

		$respuesta = new response(json_encode(array('htmlCabecera' => $htmlCabecera,'htmlCuerpo'=>$htmlCuerpo,'mes'=>$month,'anio'=>$year,'nombreMes'=>self::nombreMes($month),'htmlError'=>$htmlError,'results'=>$results)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function correctorLDResults($month,$year,$mesAnterior,$class){
		
		$em = $class->get('doctrine')->getManager();

        $events = $options = $forecasts = array();	
        $sql = "SELECT e.id as id_evento, e.fecha, e.grupo, e.nombre as nombre_evento
        FROM evento e, pronostico p, usuario_pronosticos up
        WHERE e.id = p.evento_id
        AND up.pronostico_id = p.id
        AND e.fecha >= DATE('".$year."-".$month."-01')
        AND e.fecha < NOW()
        AND e.corregido = -1
        GROUP BY e.id
        ORDER BY e.fecha";

        if( $mesAnterior==true ) { 
	       $sql = str_replace("NOW()", "DATE('".$year."-".($month+1)."-01') ", $sql);
        }

        $stmt = $em->getConnection()->prepare($sql);
        //$stmt->bindValue('year', $year);
        //$stmt->bindValue('month', $month);
        $stmt->execute();
        $arreglo = $stmt->fetchAll();


        foreach ($arreglo as $item) {
        	$events[$item['id_evento']] = $item;
        }

        if(!empty($events)){
        	$sql = "SELECT id as pronostico_id, nombre_traducido as nombre_pronostico, cuota, evento_id 
        	FROM pronostico 
        	WHERE evento_id IN (" . implode(",", array_keys($events)) .")";


        	$stmt = $em->getConnection()->prepare($sql);
            //$stmt->bindValue('year', $year);
            //$stmt->bindValue('month', $month);
        	$stmt->execute();
        	$result_pronostico = $stmt->fetchAll();

        	foreach ($result_pronostico as $item) {
        		$options[$item['evento_id']][] = $item;
        	}

        }
        return array( $events, $options );
	}

	public function borrarEventoAction(Request $request) {
        
        $array = array( );
		$em = $this->get('doctrine')->getManager();

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
		$eventoId = $post -> get("objeto");

		$sql = "DELETE from usuario_pronosticos where pronostico_id in(SELECT id from pronostico where evento_id = ". $eventoId .")";
	    $stmt = $em->getConnection()->prepare($sql);
	    $stmt->execute();
		$sql = "DELETE from pronostico where evento_id = ". $eventoId;
	    $stmt = $em->getConnection()->prepare($sql);
	    $stmt->execute();
		$sql = "DELETE from evento where id = ". $eventoId;
	    $stmt = $em->getConnection()->prepare($sql);
	    $stmt->execute();
		
		self::corregirGanancias($this);
		self::corregirPuntos($this);

		$respuesta = new response(json_encode(array('estado' => true, 'codigo' => '')));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;

	}
	public function nombreMes($month){
		$month_string ="";
		if($month==1){
			$month_string = "Enero";
		}else if($month==2){
			$month_string = "Febrero";
		}else if($month==3){
			$month_string = "Marzo";
		}else if($month==4){
			$month_string = "Abril";
		}else if($month==5){
			$month_string = "Mayo";
		}else if($month==6){
			$month_string = "Junio";
		}else if($month==7){
			$month_string = "Julio";
		}else if($month==8){
			$month_string = "Agosto";
		}else if($month==9){
			$month_string = "Septiembre";
		}else if($month==10){
			$month_string = "Octubre";
		}else if($month==11){
			$month_string = "Noviembre";
		}else if($month==12){
			$month_string = "Diciembre";
		}
		return $month_string;
	}
	public function corregirGanancias($class){

		$em = $class->get('doctrine')->getManager();
		$sql = "SELECT usuario_id from usuarios";
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		foreach ($result as $key => $usuario) {
			# code...
			$usuarioID = $usuario['usuario_id'];

			$sql = "SELECT up.puntos_jugados, p.cuota, up.cuota_jugada 
			FROM usuario_pronosticos up, pronostico p, evento e 
			WHERE p.evento_id = e.id 
			AND monthname(up.realizado_en) = monthname(now()) 
			AND year(up.realizado_en) = year(now())
			AND up.usuario_id = ". $usuarioID ." 
			AND up.pronostico_id = p.id and up.acierto = -1";

			$stmt = $em->getConnection()->prepare($sql);
			$stmt->execute();
			$resultPronosticos = $stmt->fetchAll();
            
            $ganancias = 0;
			foreach ($resultPronosticos as $clave => $pronostico) {
				# code...
				$puntosJugados = $pronostico['puntos_jugados'];
				if(!is_null($pronostico ['cuota_jugada']) && is_float((float)$pronostico['cuota_jugada']) ){
					$cuota = $pronostico['cuota_jugada'];
			    } 
			    else {
				    $cuota = $pronostico['cuota'];
			    }

			    $gananciasApuesta = (float)$puntosJugados * (float)$cuota;
			    $ganancias = $ganancias + $gananciasApuesta;
			}
			
		    $sql = "UPDATE usuarios set posibles_ganancias = ". $ganancias . " where usuario_id = ". $usuarioID;
		    $stmt = $em->getConnection()->prepare($sql);
		    $stmt->execute();
	    }
    }
	public function corregirPuntos($class){

		$em = $class->get('doctrine')->getManager();


        //$result = $conn->query ( "SELECT usuario_id, puntos_extra from usuarios");
        $sql = "SELECT usuario_id, puntos_extra from usuarios";
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		foreach ($result as $key => $usuario) {
			# code...
			$sql="SELECT up.puntos_jugados, up.acierto, p.cuota,  p.id, up.cuota_jugada
			FROM usuario_pronosticos up, pronostico p, evento e 
			WHERE p.evento_id = e.id 
			AND monthname(up.realizado_en) = monthname(now()) AND year(up.realizado_en) = year(now())
			AND up.usuario_id = ". $usuario['usuario_id'] ." and up.pronostico_id = p.id order by up.realizado_en";
			//echo $queryPronosticos;

			$stmt = $em->getConnection()->prepare($sql);
			$stmt->execute();
			$resultPronosticos = $stmt->fetchAll();

			//echo $queryPronosticos;
			if($usuario['puntos_extra'] != 0){
				$puntos = 100 + $usuario['puntos_extra'];
			}else
				$puntos = 100;
			
			//echo "Puntos:". $puntos. "<br/>";
			$acierto = 0;
			$aciertoMes = 0;
			$fallos = 0;
			$falloMes = 0;
			$nulos = 0;
			$nulosMes = 0;
			$sinCorregir = 0;
			$totalPuntos = 0;
			$pronosticosApostados = array();
			foreach ($resultPronosticos as $clave => $pronostico) {
				# code...
				$puntosJugados = $pronostico['puntos_jugados'];
				if(!is_null($pronostico ['cuota_jugada'])&& is_float((float)$pronostico['cuota_jugada']) ){
					$cuota = $pronostico['cuota_jugada'];
				} else {
					$cuota = $pronostico['cuota'];
				}
				
				//echo "Jugada: ". $puntosJugados . "ptos a cuota ". $cuota. "<br/>";
				//echo "	Resultado: ". $pronostico['acierto'] . "<br/>";
				
				$pronosticoDuplicado = 0;
				//print_r($pronosticosApostados);
				foreach ($pronosticosApostados as $i => $pronosticoApostado) {		
					if($pronostico['id'] == $pronosticoApostado) {
						$stmt = $em->getConnection()->delete('usuario_pronosticos',  array('pronostico_id' => $pronostico['id'], 'usuario_id' => $usuario['usuario_id'], 'puntos_jugados' => $puntosJugados));
						$pronosticoDuplicado = 1;
						break;						
					}
				}
				//echo "pronostico duplicado:". $pronosticoDuplicado;
				if($pronosticoDuplicado == 1){
					//echo "Pronostico duplicado". $pronostico['id'];
					continue;
				}
				
				if($puntosJugados > ($puntos*20/100)){
					$puntosJugados = $puntos*20/100;
					$sql = "UPDATE usuario_pronosticos set puntos_jugados = ". $puntosJugados . " where pronostico_id = ". $pronostico['id']. " and usuario_id = '".$usuario['usuario_id'] ."'";
					//echo $updatePuntos;
					$stmt = $em->getConnection()->prepare($sql);
			        $stmt->execute();

				}
				
				
				if($pronostico['acierto'] == 1){
					$gananciasApuesta = (float)$puntosJugados * (float)$cuota;
					$puntos = $puntos + ($gananciasApuesta - $puntosJugados);
					$acierto++;
				}elseif ($pronostico['acierto'] == 0){
					$puntos = $puntos - $puntosJugados;
					$fallos++;
				}elseif($pronostico['acierto'] == -1){
					$puntos = $puntos - $puntosJugados;
					$sinCorregir++;
				}elseif($pronostico['acierto'] == -2){
					$puntos = $puntos + $puntosJugados;
					$nulos++;
				}
				//echo "	Puntos despues de jugada:". $puntos. "/OK:". $acierto. "/Error:".$fallos."/Nulo:".$nulos."/SC:".$sinCorregir."<br/>";
				$pronosticosApostados[] = $pronostico['id'];
			}

			$totalPuntos = $acierto + $fallos + $nulos + $sinCorregir;
			$sql = "UPDATE usuarios set puntos = ". $puntos . ", apuestas_hechas = ". $totalPuntos. ", apuestas_acertadas = ". $acierto .", apuestas_falladas = ". $fallos .", apuestas_nulas = ". $nulos ." where usuario_id = ". $usuario['usuario_id'];
			$stmt = $em->getConnection()->prepare($sql);
			$stmt->execute();

			if($totalPuntos == 0){
				$sql = "UPDATE usuarios set ha_jugado = 0 where usuario_id = ". $usuario['usuario_id'];
				$stmt = $em->getConnection()->prepare($sql);
			    $stmt->execute();
			}
		}
    }
	public function corregirEventoAction(Request $request) {
        
        $array = array( );
		$em = $this->get('doctrine')->getManager();

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
		$idEvento = $post -> get("idEvento");
		$valuePronosticoCorregido = $post -> get("valuePronosticoCorregido");


		self::corregirPronostico($idEvento,$valuePronosticoCorregido,$this);

		$respuesta = new response(json_encode(array('estado' => true, 'codigo' => '')));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;

	}
	public function corregirPronostico($eventoId, $pronosticoCorregido,$class){

		$em = $class->get('doctrine')->getManager();


		if ($pronosticoCorregido != - 1) {
			$sql =  "UPDATE evento SET corregido = " . $pronosticoCorregido . " where id='" . $eventoId . "'";
		    $stmt = $em->getConnection()->prepare($sql);
		    $stmt->execute();

			$sql = "SELECT up.usuario_id, up.pronostico_id, up.acierto, up.puntos_jugados, p.cuota, up.cuota_jugada 
			FROM usuario_pronosticos up, pronostico p 
			WHERE up.pronostico_id in (SELECT id FROM pronostico WHERE evento_id = '" . $eventoId . "') 
			AND p.id = up.pronostico_id";
		    $stmt = $em->getConnection()->prepare($sql);
		    $stmt->execute();
		    $usuarioPronosticosACorregir = $stmt->fetchAll();

		    foreach ($usuarioPronosticosACorregir as $key => $usuarioPronostico) {
		    	# code...
		    	if(!is_null($usuarioPronostico ['cuota_jugada'])
		    		&& is_float((float)$usuarioPronostico['cuota_jugada']) ){
		    		$cuota = (float)$usuarioPronostico['cuota_jugada'];
		        } 
		        else {
		    	$cuota = (float)$usuarioPronostico['cuota'];
		        }
		        if ($pronosticoCorregido == -2) {
				//echo "Nulo";
		    	$sql = "UPDATE usuario_pronosticos SET acierto = 2 where usuario_id = " . $usuarioPronostico ['usuario_id'] . " and pronostico_id = " . $usuarioPronostico ['pronostico_id'];
		        $stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();
				//echo $toUpdatePronostico;
		    	$sql = "SELECT * FROM usuarios where usuario_id = " . $usuarioPronostico ['usuario_id'];
		    	$stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();
		        $usuario = $stmt->fetchAll();
		        $usuario = $usuario[0];

		    	$puntos = $usuario ['puntos'] + $usuarioPronostico ['puntos_jugados'];
		    	$ganancias = $usuario ['posibles_ganancias'] - ((float)$usuarioPronostico['puntos_jugados'] * $cuota);
		    	$nulos = $usuario ['apuestas_nulas'] + 1;
		    	$sql =  "UPDATE usuarios SET puntos = " . $puntos . ", posibles_ganancias = " . $ganancias . ", apuestas_nulas = " . $nulos . " where usuario_id = " . $usuarioPronostico ['usuario_id'];
		        $stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();			
		        }
		        else if ($pronosticoCorregido == $usuarioPronostico ['pronostico_id']) {
				//echo "Acierto";
		    	$sql = "UPDATE usuario_pronosticos SET acierto = 1 where usuario_id = " . $usuarioPronostico ['usuario_id'] . " and pronostico_id = " . $usuarioPronostico ['pronostico_id'];
				//echo $toUpateUsuarioPronostico;
		        $stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();
		    	$sql = "SELECT * FROM usuarios where usuario_id = " . $usuarioPronostico ['usuario_id'];
		    	$stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();
		        $usuario = $stmt->fetchAll();
		        $usuario = $usuario[0];

		    	$puntos = $usuario ['puntos'] + ((float)$usuarioPronostico ['puntos_jugados'] * $cuota);
		    	$ganancias = $usuario ['posibles_ganancias'] - ($usuarioPronostico ['puntos_jugados'] * $cuota);
		    	$aciertos = $usuario ['apuestas_acertadas'] + 1;
		    	$sql = "UPDATE usuarios SET puntos = " . $puntos . ", posibles_ganancias = " . $ganancias . ", apuestas_acertadas = " . $aciertos . " where usuario_id = " . $usuarioPronostico ['usuario_id'];
		        $stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();		
		        } 
		        else {
				//echo "Fallo";
		    	$sql = "UPDATE usuario_pronosticos SET acierto = 0 where usuario_id = " . $usuarioPronostico ['usuario_id'] . " and pronostico_id = " . $usuarioPronostico ['pronostico_id'];
				//echo $toUpateUsuarioPronostico;
		    	$stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();

		    	$sql = "SELECT * FROM usuarios where usuario_id = " . $usuarioPronostico ['usuario_id'];
		    	$stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();
		        $usuario = $stmt->fetchAll();
		        $usuario = $usuario[0];

		    	$ganancias = $usuario ['posibles_ganancias'] - ((float)$usuarioPronostico ['puntos_jugados'] * $cuota);
		    	$fallos = $usuario ['apuestas_falladas'] + 1;
		    	$sql = "UPDATE usuarios SET posibles_ganancias = " . $ganancias . ", apuestas_falladas = " . $fallos . " where usuario_id = " . $usuarioPronostico ['usuario_id'];
		    	$stmt = $em->getConnection()->prepare($sql);
		        $stmt->execute();	
		        } 
		    }

		//echo "Corregidos todos los usuarios para el evento ". $eventoId . " y el pronostico ". $pronosticoCorregido;
		    return 1;
	    }

    }


	public function recorrectorLDAction(Request $request) {

        $array = array( );
		$em = $this->get('doctrine')->getManager();

        $month = date("m");
        $year = date("Y");

		$helpers = self::recorrectorLDResults($month,$year,false,$this);

        $array['events'] = $helpers[0];
        //$array['elements'] = $arreglo;
        $array['nombreMes'] = self::nombreMes($month);
        $array['mes'] = $month;
        $array['anio'] = $year;
        $array['options'] = $helpers[1];
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':recorrector-ld.html.twig', $array);
	}
	public function recorrectorLDMesAnteriorAction(Request $request) {
        
        $array = array( );
		$em = $this -> getDoctrine() -> getManager();

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
	    $fecha = $post -> get("fecha");
	    $fecha = explode("-", $fecha);

	    $month =  intval($fecha[0]);
        $year  =  intval($fecha[1]);

        if($month==1){
        	$month = 12;
        	$year = $year - 1;
        }
        else{
        	$month = $month -1;
        }

		$helpers = self::recorrectorLDResults($month,$year,true,$this);

        $array['events'] = $helpers[0];
        $array['options'] = $helpers[1];


        $htmlCabecera ='';
        $htmlCuerpo ='';
        $htmlError = '';
        $results= false;
        if(count($array['events'])>0){
        	$results= true;
		    $htmlCabecera = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':cabecera-recorrector-ld.html.twig' );
		    $htmlCuerpo = $this -> renderView('ProjectBackBundle:'.self::NOMBRE_CLASE.':list-element-recorrector-ld.html.twig', $array );
        }
        else{
        	$htmlError = $this -> renderView('ProjectBackBundle:Helpers:busqueda-fallida.html.twig' );
        }

		$respuesta = new response(json_encode(array('htmlCabecera' => $htmlCabecera,'htmlCuerpo'=>$htmlCuerpo,'mes'=>$month,'anio'=>$year,'nombreMes'=>self::nombreMes($month),'htmlError'=>$htmlError,'results'=>$results)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function recorrectorLDResults($month,$year,$mesAnterior,$class){
		
		$em = $class->get('doctrine')->getManager();

        $events = $options = $forecasts = array();	
        $sql = "SELECT e.id as id_evento, e.fecha, e.grupo, e.nombre as nombre_evento, e.corregido, p.nombre_traducido as pronostico_corregido
        FROM evento e, pronostico p	
        WHERE e.corregido = p.id
        AND e.fecha >= DATE('".$year."-".$month."-01')
        AND e.fecha < DATE('".$year."-".($month+1)."-01')
        AND e.corregido <> -1
        GROUP BY e.id
        ORDER BY e.fecha";

        $stmt = $em->getConnection()->prepare($sql);
        //$stmt->bindValue('year', $year);
        //$stmt->bindValue('month', $month);
        $stmt->execute();
        $arreglo = $stmt->fetchAll();


        foreach ($arreglo as $item) {
        	$events[$item['id_evento']] = $item;
        }

        if(!empty($events)){
        	$sql = "SELECT id as pronostico_id, nombre_traducido as nombre_pronostico, cuota, evento_id 
        	FROM pronostico 
        	WHERE evento_id IN (" . implode(",", array_keys($events)) .")";


        	$stmt = $em->getConnection()->prepare($sql);
            //$stmt->bindValue('year', $year);
            //$stmt->bindValue('month', $month);
        	$stmt->execute();
        	$result_pronostico = $stmt->fetchAll();

        	foreach ($result_pronostico as $item) {
        		$options[$item['evento_id']][] = $item;
        	}

        }
        return array( $events, $options );
	}
	public function recorregirEventoAction(Request $request) {
        
        $array = array( );
		$em = $this->get('doctrine')->getManager();

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		// Obtener variables del post en el ajax
		$idEvento = $post -> get("idEvento");
		$idPronosticoAnterior = $post -> get("idPronosticoAnterior");
		$idPronosticoNuevo = $post -> get("idPronosticoNuevo");

        self::deshacerCorreccion($idEvento, $idPronosticoAnterior,$this);
        self::corregirPronostico($idEvento, $idPronosticoNuevo,$this);


		$respuesta = new response(json_encode(array('estado' => true, 'codigo' => '')));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;

	}

	public function deshacerCorreccion($eventoId, $pronosticoCorregido,$class) {




		$em = $class->get('doctrine')->getManager();

		if ($pronosticoCorregido != - 1) {

		//Primero corregimos la entrada en la tabla de evento. 
			$sql =  "UPDATE evento SET corregido = -1 WHERE id='" . $eventoId . "'";
			$stmt = $em->getConnection()->prepare($sql);
			$stmt->execute();
		// Luego cogemos todos los campos acierto en la tabla de pronosticos de usuarios
			$sql =  "UPDATE usuario_pronosticos SET acierto=-1 
			WHERE pronostico_id 
			IN ( SELECT id FROM pronostico WHERE evento_id=".$eventoId.")";
			$stmt = $em->getConnection()->prepare($sql);
			$stmt->execute();

		//Este fichero se encarga de corregir la tabla de usuarios. Así que no hace falta ponernos a hacerlo nostros.  
			self::corregirPuntos($class);
		//echo "Corregidos todos los usuarios para el evento ". $eventoId . " y el pronostico ". $pronosticoCorregido;
			return 1;
		} 
		else {
			return 0;
		}

	}

}