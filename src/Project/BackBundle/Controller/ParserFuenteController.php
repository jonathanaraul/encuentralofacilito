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
use Project\UserBundle\Entity\Fuente;
use Project\UserBundle\Entity\Noticia;

class ParserFuenteController extends Controller {

const NOMBRE_CLASE = 'Fuente';
const NOMBRE_RUTA = 'fuente';

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_list');
		$form = null;		
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:".self::NOMBRE_CLASE." o ";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 30);

		$array = array('pagination'=> $pagination, 'filtros'=> $filtros, 'url'=> $url);
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;
		
		return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':list.html.twig', $array);
	}

	public function createAction(Request $request) {

		$array = array('accion' => 'nuevo');
		$array['url'] = $this-> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_create');
		$array['data'] = new Fuente();

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

    	    $html = file_get_contents($data->getUrl());
    	    $data->setRss(self::getRSSLocation($html, $data->getUrl()));

        	$em-> persist($data);
        	$em-> flush();

        	return $class-> redirect($class-> generateUrl('project_back_parser_'.self::NOMBRE_RUTA.'_list'));
        }

		$array['form'] = $form-> createView();
		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;

		return $class-> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':new-edit.html.twig', $array);
	}

    public function rssAction($id, Request $request){

    	$em = $this-> getDoctrine()-> getManager();
    	$array = array('accion' => 'rss');
    	$array['id'] = $id;

		$array['data'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:'.self::NOMBRE_CLASE)-> find($id);
		if (!$array['data']) {
			throw $this-> createNotFoundException('La pagina que intenta acceder no existe ');
		}

        $array['articulos'] = simplexml_load_string(file_get_contents($array['data']->getRss()));

		$array['nombreClase'] =  self::NOMBRE_CLASE;
		$array['nombreRuta'] =  self::NOMBRE_RUTA;

        return $this -> render('ProjectBackBundle:'.self::NOMBRE_CLASE.':rss.html.twig', $array);
    }

	public static function getRSSLocation($html, $location){
		if(!$html or !$location){
			return null;
		}else{
        #search through the HTML, save all <link> tags
        # and store each link's attributes in an associative array
			preg_match_all('/<link\s+(.*?)\s*\/?>/si', $html, $matches);
			$links = $matches[1];
			$final_links = array();
			$link_count = count($links);
			for($n=0; $n<$link_count; $n++){
				$attributes = preg_split('/\s+/s', $links[$n]);
				foreach($attributes as $attribute){
					$att = preg_split('/\s*=\s*/s', $attribute, 2);
					if(isset($att[1])){
						$att[1] = preg_replace('/([\'"]?)(.*)\1/', '$2', $att[1]);
						$final_link[strtolower($att[0])] = $att[1];
					}
				}
				$final_links[$n] = $final_link;
			}
        #now figure out which one points to the RSS file
			for($n=0; $n<$link_count; $n++){
				if(strtolower($final_links[$n]['rel']) == 'alternate'){
					if(strtolower($final_links[$n]['type']) == 'application/rss+xml'){
						$href = $final_links[$n]['href'];
					}
					if(!$href and strtolower($final_links[$n]['type']) == 'text/xml'){
                    #kludge to make the first version of this still work
						$href = $final_links[$n]['href'];
					}
					if($href){
                    if(strstr($href, "http://") !== null){ #if it's absolute
                    $full_url = $href;
                    }else{ #otherwise, 'absolutize' it
                    $url_parts = parse_url($location);
                        #only made it work for http:// links. Any problem with this?
                    $full_url = "http://$url_parts[host]";
                    if(isset($url_parts['port'])){
                    	$full_url .= ":$url_parts[port]";
                    }
                        if($href{0} != '/'){ #it's a relative link on the domain
                        $full_url .= dirname($url_parts['path']);
                        if(substr($full_url, -1) != '/'){
                                #if the last character isn't a '/', add it
                        	$full_url .= '/';
                        }
                    }
                    $full_url .= $href;
                }
                return $full_url;
            }
        }
    }
    return null;
}
}
}
