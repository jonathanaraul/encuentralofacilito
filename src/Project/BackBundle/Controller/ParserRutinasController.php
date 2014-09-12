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
use Project\UserBundle\Entity\Error;


class ParserRutinasController extends Controller {

    public static function rutinasAction($em,$rutaImagenes,$class){

        
        $array = array('contadorImagenes'=>0,'contadorPronosticos'=>0,'contadorNoticias'=>0,'error'=>array());
        
        //echo'<br>pasando por jocprivate';
        ini_set('max_execution_time', 300);
        try{
        $array = self::jocPrivatAction($em,$rutaImagenes,$array,$class);
           }
        catch (\Exception $e) {
            $array['error'][count($array['error'])]  = $e->getMessage();
            $object = new Error();
            $object -> setDescripcion($e->getMessage());
            $em -> persist($object);
            $em -> flush();
        }

        try{
        //El recreativo
        //echo'<br>pasando por el recreativo';
        ini_set('max_execution_time', 300);
        $fuente = $em -> getRepository('ProjectUserBundle:Fuente') -> find(10);
        $array = self::rssGenericoNoticia($em,$rutaImagenes,$array, $fuente, $fuente->getRss(),$class);
           }
        catch (\Exception $e) {
            $array['error'][count($array['error'])]  = $e->getMessage();
            $object = new Error();
            $object -> setDescripcion($e->getMessage());
            $em -> persist($object);
            $em -> flush();
        }
        
        try{
        //YogonetLatinoamerica
        //echo'<br>pasando por yogonetlatinoamerica';
        ini_set('max_execution_time', 300);
        $fuente = $em -> getRepository('ProjectUserBundle:Fuente') -> find(13);
        $array = self::yogonetLatinoamericaAction($em,$rutaImagenes,$array,$fuente,$class);
           }
        catch (\Exception $e) {
            $array['error'][count($array['error'])]  = $e->getMessage();
            $object = new Error();
            $object -> setDescripcion($e->getMessage());
            $em -> persist($object);
            $em -> flush();
        }
        
        try{
        //SomosNBA
        //echo'<br>pasando por somosnba';
        ini_set('max_execution_time', 300);
        $fuente = $em -> getRepository('ProjectUserBundle:Fuente') -> find(16);
        $array = self::somosNBAAction($em,$rutaImagenes,$array,$fuente,$class);
           }
        catch (\Exception $e) {
            $array['error'][count($array['error'])]  = $e->getMessage();
            $object = new Error();
            $object -> setDescripcion($e->getMessage());
            $em -> persist($object);
            $em -> flush();
        }
        
        try{
        //echo'<br>pasando por sectorgrambling';
        ini_set('max_execution_time', 300);
        $fuente = $em -> getRepository('ProjectUserBundle:Fuente') -> find(11);
        $array = self::sectorGamblingAction($em,$rutaImagenes,$array,$fuente,$class);
           }
        catch (\Exception $e) {
            $array['error'][count($array['error'])]  = $e->getMessage();
            $object = new Error();
            $object -> setDescripcion($e->getMessage());
            $em -> persist($object);
            $em -> flush();
        }
        
        try{
        //echo'<br>pasando por sectordeljuego';
        ini_set('max_execution_time', 300);
        $fuente = $em -> getRepository('ProjectUserBundle:Fuente') -> find(9);
        $array = self::sectorDelJuegoAction($em,$rutaImagenes,$array,$fuente,$class);
        ini_set('max_execution_time', 300);
           }
        catch (\Exception $e) {
            $array['error'][count($array['error'])]  = $e->getMessage();
            $object = new Error();
            $object -> setDescripcion($e->getMessage());
            $em -> persist($object);
            $em -> flush();
        }

        ini_set('max_execution_time', 300);
        try{
        //echo'<br>pasando por sectordeljuego';
        ini_set('max_execution_time', 300);
        $array = self::parsearApuestasDeportivasAction($em,$rutaImagenes,$array,$class);
        }
        catch (\Exception $e) {
            $array['error'][count($array['error'])]  = $e->getMessage();
            $object = new Error();
            $object -> setDescripcion($e->getMessage());
            $em -> persist($object);
            $em -> flush();
        }

        return $array;

    }
    public function indexAction(Request $request) {
        
        $em = $this -> getDoctrine() -> getManager();
        $rutaImagenes = $this -> container -> getParameter('kernel.root_dir') . '/../web/uploads/images' ;
        $array = self::rutinasAction($em,$rutaImagenes,$this);
        return $this -> render('ProjectBackBundle:Default:parseo.html.twig', $array);

    }
 public static function parsearApuestasDeportivasAction($em,$rutaImagenes,$array,$class) {


        $url = 'http://www.apuestas-deportivas.es/pronostico/';
        ini_set('max_execution_time', 300);

        $htm = file_get_contents($url);

        $str = '<div class="content">';
        $arr = explode($str, $htm);
        $arr = explode('<td', $arr[1]);

        $contenido = $arr[0];

        $enlaces = explode("http://www.apuestas-deportivas.es/pronostico/", $contenido);
        $idNoticias = array();

        for ($i=1; $i < count($enlaces); $i++) { 
            $cadena = $enlaces[$i];
            $posicionFinal = strpos($cadena, '"');
            $id = substr($cadena, 0, $posicionFinal);
            if($i!=(count($enlaces)-1))$idNoticias[$i-1] = $id;
                    }

        $idNoticias = array_unique($idNoticias); 

        foreach ($idNoticias as $key => $value) {
            ini_set('max_execution_time', 300);
            // Tener en cuenta que no es igual la ruta lista_noticias a detalle_noticia
            $urlNoticia = "http://www.apuestas-deportivas.es/pronostico/".$value;
            
            $html = file_get_contents($urlNoticia);
            $busqueda = '<div class="content">';
            $html = explode($str, $html);
            $html = explode('<p class="postmetadata">', $html[1]);
            $html = $html[0];

            //Se comienza a extraer los datos de interes, se comienza con el TITULO, el cual se almacena en 
            //<div id="TITULAR_DETALLE">
            $busqueda = '<h1>';
            $titulo = explode($busqueda, $html);
            $titulo = explode('</h1>', $titulo[1]);
            $titulo = $titulo[0];

            $imagen = $titulo[1];//Se almacenan varias lineas de codigo entre ellas la imagen <img>
            $titulo = $titulo[0];//Se almacena unicamente el titulo por ende estaria listo para guardarse

            //Se procede a procesar la IMAGEN
            $busqueda = 'src="';
            $imagen = explode($busqueda, $html);
            $imagen = explode('"', $imagen[1]);
            $imagen = $imagen[0];


            $urlImagen = $imagen;
            $extension = explode(".", $urlImagen);
            $extension = $extension[count($extension) - 1];
            $path = $rutaImagenes;
            $nombreImagen = sha1($urlImagen);

            ini_set('max_execution_time', 300);
            $ch = curl_init($urlImagen);
            $fp = fopen(sprintf('%s/%s.%s',  $path, $nombreImagen, $extension), 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            $nombreLimpio = UtilitiesAPI::limpiaNombre($titulo, $class);

            $imagen = new Imagen();
            $imagen -> setNombre($nombreLimpio);
            $imagen -> setTags(UtilitiesAPI::convierteATags($nombreLimpio, $class));
            $imagen -> setPath($nombreImagen . '.' . $extension);
            $em -> persist($imagen);
            $em -> flush();
            $array['contadorImagenes']++;
        
            //Se procede a buscar el contenido el cual se encuentra en <div class="CUERPO_DETALLE">
            $busqueda = '<div class="entry">';
            $contenido = explode($busqueda, $html);
            $contenido = explode('<p class="postmetadata">', $contenido[1]);
            $contenido = $contenido[0];

            $busqueda = 'Evento:';
            $evento = explode($busqueda, $contenido);

           
            if(isset($evento[1])){
               $evento = explode('Fecha:', $evento[1]);
            }

            if(isset($evento[1])){
              $fecha = $evento[1];
            }
            else{
               $fecha = 'YYY-mm-dd<strong';
            }
            
            $evento = $evento[0];

            $busqueda = '<strong';
            $fecha = explode($busqueda, $fecha);
            $fecha = $fecha[0];
            
            
            $pronostico = explode('Pronóstico de apuestas:', $contenido);
            if(isset( $pronostico[1])){
               $pronostico = $pronostico[1];
            }
            else{
                $pronostico = "<br0";
            }
            
            
            $busqueda = '<br';
            $pronostico = explode($busqueda, $pronostico);
            $cuota = $pronostico[1];
            $pronostico= $pronostico[0];

            $cuota = explode('Cuota:', $cuota);
            if(isset( $cuota[1])){
               $cuota = $cuota[1];
            }
            else{
               $cuota = 0.0;
            }
          
            
            $busqueda = 'Stake: ';
            $skate = explode($busqueda, $contenido);
            if(isset( $skate[1])){
               $skate = explode('Canti', $skate[1]);
            }
            else{
               $skate = array("");
            }
          
           
            
            if(isset( $skate[1])){
               $casaApuestas = $skate[1];
               $busqueda = 'strong>';
               $casaApuestas = explode($busqueda, $casaApuestas);
               $casaApuestas = $casaApuestas[1];
               $busqueda = '<';
               $casaApuestas = explode($busqueda, $casaApuestas);    
               $casaApuestas = $casaApuestas[0];  
           }
           else{
             $casaApuestas = '';
           }
            
            //limpieza final
            $skate = $skate[0];
            $skate = explode('<br/>', $skate);
            $skate = $skate[0];
            $skate = explode('</strong>', $skate);
            $skate = $skate[0];

            $fecha = explode('<br/>', $fecha);
            $fecha = $fecha[0];           

            $evento = explode('</strong><br/>', $evento);
            $evento = $evento[0];           

            $helper = explode('<strong>', $evento);
            if(isset( $helper[1]))$evento = $helper[1];  
    
            //Se obtienen los datos basicos relacionados con la noticia
            $usuario = $em -> getRepository('ProjectUserBundle:User') -> find(1);
            $fuente = $em -> getRepository('ProjectUserBundle:Fuente') -> find(9);

            $object = new Pronostico();

            $object -> setCuota($cuota);
            $object -> setSkate($skate);
            $object -> setFecha($fecha);
            $object -> setEvento($evento);
            $object -> setPronostico($pronostico);
            $object -> setCasaApuestas($casaApuestas);
            $object -> setFuente($fuente);
            $object -> setUser($usuario);
            $object -> setNombre($titulo);
            $object -> setDescripcion($contenido);
            $em -> persist($object);
            $em -> flush();
            
            $array['contadorPronosticos']++;
        }

        


        return $array;
        }
    public static function rssGenericoNoticia($em,$rutaImagenes,$array,$fuente,$url,$class) {

        //$em = $class -> getDoctrine() -> getManager();

        ini_set('max_execution_time', 300);
        $data = simplexml_load_string(file_get_contents($url));
        //var_dump($data);exit;
        //ladybug_dump($data);exit;

        $generico = null;
        if(isset($data->entry)) $generico = $data->entry;
        else if(isset($data->channel)) $generico = $data->channel->item;
        
        foreach ($generico as $feed) {
            //echo'paso por aqui';

            $elemento = $em -> getRepository('ProjectUserBundle:Noticia') -> findByNombre($feed -> title);
            if ($elemento) break 1;

            $object = new Noticia();
            $cadena = '';

            if(isset( $feed -> description ) ) $cadena = $feed -> description;
            if(isset( $feed -> content ) ) $cadena = $feed -> content;

            //$contadorNoticias++;

            //Busqueda de imagenes en el texto
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom -> loadHTML("<html><body>" . $cadena . "<br></body></html>");
            $xpath = new \DOMXpath($dom);
            $result = $xpath -> query('//img/@src');
            $imagen = null;
            $nombreImagen ="";

            //Si consigue por lo menos una imagen, la descarga del servidor
            //La guarda en uploads y crea un registro en la bd
            if ($result -> length > 0) {

                ini_set('max_execution_time', 300);
                $nombre = explode("?", $result -> item(0) -> nodeValue);
                $nombre = $nombre[0];
                $extension = explode(".", $nombre);
                $extension = $extension[count($extension) - 1];
                //$path = 'C:/wamp/www/tnparseojocprivat/uploads';
                $path = $rutaImagenes;
                $nombreImagen = sha1($nombre);

                $ch = curl_init($nombre);
                $fp = fopen(sprintf('%s/%s.%s', $path, $nombreImagen, $extension), 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
                //$nombreImagen = $nombreImagen.'.'. $extension;                

                $nombreLimpio = UtilitiesAPI::limpiaNombre($object -> getNombre(), $class);
                $imagen = new Imagen();
                $imagen -> setNombre($nombreLimpio);
                $imagen -> setTags(UtilitiesAPI::convierteATags($nombreLimpio, $class));
                $imagen -> setPath($nombreImagen . '.' . $extension);
                //$imagen -> setIp($class -> container -> get('request') -> getClientIp());
                $em -> persist($imagen);
                $em -> flush();

                $array['contadorImagenes']++;
                
            }

            $usuario = $em -> getRepository('ProjectUserBundle:User') -> find(1);

            $object -> setFuente($fuente);
            $object -> setUser($usuario);
            $object -> setNombre($feed -> title);
            $object -> setDescripcion($cadena);
            if($imagen != null)$object -> setImagen($imagen);
            $em -> persist($object);
            $em -> flush();
            $array['contadorNoticias']++;
        } 

        return $array;
        
        }

    public static function sectorGamblingAction($em,$rutaImagenes,$array,$fuente,$class) {

        //$em = $class -> getDoctrine() -> getManager();

        $url = 'http://www.sectorgambling.com/';

        ini_set('max_execution_time', 300);
        $htm = file_get_contents($url);

        $str = '<div id="left-area">';
        $arr = explode($str, $htm);
        $arr = explode('sidebar', $arr[1]);

        $contenido = $arr[0];

        $enlaces = explode("http://www.sectorgambling.com/2014", $contenido);
        
        $idNoticias = array();

        for ($i=1; $i < count($enlaces); $i++) 
        { 
            $cadena = $enlaces[$i];
            $posicionFinal = strpos($cadena, '"');
            $id = substr($cadena, 0, $posicionFinal);
            $idNoticias[$i] = $id;
        }

        $idNoticias = array_unique($idNoticias); 

        foreach ($idNoticias as $key => $value) {
            ini_set('max_execution_time', 300);  
            // Tener en cuenta que no es igual la ruta lista_noticias a detalle_noticia
            $urlNoticia = "http://www.sectorgambling.com/2014".$value;

            $html = file_get_contents($urlNoticia);
            $busqueda = '<div class="entry post clearfix">';
            $html = explode($busqueda, $html);

            $html = $html[1];
            $html = explode('sharedaddy sd-sharing-enabled', $html);
            $html = $html[0];

            $busqueda = '<h1 class="title">';
            $titulo = explode($busqueda, $html);
            $titulo = explode('</h1', $titulo[1]);
            $titulo = $titulo[0];

            $elemento = $em -> getRepository('ProjectUserBundle:Noticia') -> findByNombre($titulo);
            if ($elemento) break;

            $busqueda = 'src="';
            $elemento = explode($busqueda, $html);
            $imagen = null;

            if(count($elemento)>1){

            $imagen = explode('"', $elemento[1]);
            $imagen = $imagen[0];

            $urlImagen = $imagen;
            $extension = explode(".", $urlImagen);
            $extension = $extension[count($extension) - 1];
            $path = $rutaImagenes;
            $nombreImagen = sha1($urlImagen);

            ini_set('max_execution_time', 300);
            $ch = curl_init($urlImagen);
            $fp = fopen(sprintf('%s/%s.%s', $path, $nombreImagen, $extension), 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            $nombreLimpio = UtilitiesAPI::limpiaNombre($titulo, $class);
            $imagen = new Imagen();
            $imagen -> setNombre($nombreLimpio);
            $imagen -> setTags(UtilitiesAPI::convierteATags($nombreLimpio, $class));
            $imagen -> setPath($nombreImagen . '.' . $extension);
            //$imagen -> setIp($class -> container -> get('request') -> getClientIp());
            $em -> persist($imagen);
            $em -> flush();
            $array['contadorImagenes']++;
            }
        
            //Se procede a buscar el contenido el cual se encuentra en <div class="CUERPO_DETALLE">
            $busqueda = '<div class="thumb">';
            $contenido = explode($busqueda, $html);
            $contenido = explode('</div>', $contenido[1]);
            $contenido = $contenido[1];
           
            //Se obtienen los datos basicos relacionados con la noticia
            $usuario = $em -> getRepository('ProjectUserBundle:User') -> find(1);
            
            //Se almacena la noticia
            $object = new Noticia();
            $object -> setFuente($fuente);
            $object -> setUser($usuario);
            $object -> setNombre($titulo);
            if($imagen != null)$object -> setImagen($imagen);
            $object -> setDescripcion($contenido);
            $em -> persist($object);
            $em -> flush();

            $array['contadorNoticias']++;

        }

        return $array;
    }

    public static function sectorDelJuegoAction($em,$rutaImagenes,$array,$fuente,$class) {

        //$em = $class -> getDoctrine() -> getManager();
        $url = 'http://sectordeljuego.com/lista_noticias.php';

        $htm = file_get_contents($url);

        $str = '<div id="LATERAL_IZQUIERDO_DETALLE" class="LATERAL_IZQUIERDO_DETALLE">';
        $arr = explode($str, $htm);
        $arr = explode('</div', $arr[1]);

        $contenido = $arr[1];

        $enlaces = explode("detalle_noticia.php?id=", $contenido);

        $idNoticias = array();
        
        for ($i=1; $i < count($enlaces); $i++) { 
            $cadena = $enlaces[$i];
            $posicionFinal = strpos($cadena, '"');
            $id = substr($cadena, 0, $posicionFinal);
            $idNoticias[$i-1] = $id;
                    }

        $idNoticias = array_unique($idNoticias); 

        foreach ($idNoticias as $key => $value) {
            ini_set('max_execution_time', 300);

            $urlNoticia = "http://sectordeljuego.com/detalle_noticia.php?id=".$value;
    
            $html = file_get_contents($urlNoticia);
            $busqueda = '<div id="NOTICIA_DETALLE">';
            $html = explode($busqueda, $html);
            $html = $html[1];

            $busqueda = '<div id="TITULAR_DETALLE">';
            $titulo = explode($busqueda, $html);
            $titulo = explode('</div', $titulo[1]);

            $parteB = $titulo[1];//Se almacenan varias lineas de codigo entre ellas la imagen <img>
            $titulo = $titulo[0];//Se almacena unicamente el titulo por ende estaria listo para guardarse

            $elemento = $em -> getRepository('ProjectUserBundle:Noticia') -> findByNombre($titulo);
            if ($elemento) break;

            $busqueda = 'src="';
            $elemento = explode($busqueda, $parteB);
            if(count($elemento)>1){
            $imagen = explode('"', $elemento[1]);
            $imagen = $imagen[0];

            $urlImagen = 'http://sectordeljuego.com/'.$imagen;
            $extension = explode(".", $urlImagen);
            $extension = $extension[count($extension) - 1];
            $path = $rutaImagenes;
            $nombreImagen = sha1($urlImagen);

            ini_set('max_execution_time', 300);
            $ch = curl_init($urlImagen);
            $fp = fopen(sprintf('%s/%s.%s', $path, $nombreImagen, $extension), 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            $nombreLimpio = UtilitiesAPI::limpiaNombre($titulo, $class);
            $imagen = new Imagen();
            $imagen -> setNombre($nombreLimpio);
            $imagen -> setTags(UtilitiesAPI::convierteATags($nombreLimpio, $class));
            $imagen -> setPath($nombreImagen . '.' . $extension);
            //$imagen -> setIp($class -> container -> get('request') -> getClientIp());
            $em -> persist($imagen);
            $em -> flush();
            $array['contadorImagenes']++;
            }
        
            $busqueda = '<div class="CUERPO_DETALLE">';
            $contenido = explode($busqueda, $html);
            $contenido = explode('</div', $contenido[1]);
            $contenido = $contenido[0];

            $usuario = $em -> getRepository('ProjectUserBundle:User') -> find(1);
            
            //Se almacena la noticia
            $object = new Noticia();
            $object -> setFuente($fuente);
            $object -> setUser($usuario);
            $object -> setNombre($titulo);
            if($imagen != null)$object -> setImagen($imagen);
            $object -> setDescripcion($contenido);
            $em -> persist($object);
            $em -> flush();


            $array['contadorNoticias']++;
        }

        return $array;
        }


    public static function somosNBAAction($em,$rutaImagenes,$array,$fuente,$class) 
    {
        //$em = $class -> getDoctrine() -> getManager();

        $url = 'http://www.somosnba.com/';

        ini_set('max_execution_time', 300);
        $htm = file_get_contents($url);

        $str = "id=\"content\">";
        $arr = explode($str, $htm);
        $arr = explode('<div id="sidebar-primary"', $arr[1]);

        $contenido = $arr[0];

        $enlaces = explode('http://www.somosnba.com/2014/', $contenido);

        $idNoticias = array();

        for ($i=1; $i < count($enlaces); $i++) 
        { 
            $cadena = $enlaces[$i];
            $posicionFinal = strpos($cadena, '"');
            $id = substr($cadena, 0, $posicionFinal);
            if( strpos($id, '#') <=0)$idNoticias[$i-1] = $id;
        }

        $idNoticias = array_unique($idNoticias);

        foreach ($idNoticias as $key => $value) 
        {
            ini_set('max_execution_time', 300);
            // Tener en cuenta que no es igual la ruta lista_noticias a detalle_noticia
            $urlNoticia = "http://www.somosnba.com/2014/".$value;
            
            $html = file_get_contents($urlNoticia);
            $busqueda = "id=\"content\">";
            $html = explode($busqueda, $html);
            
            $html = explode('pd-rating', $html[1]);
            $html = $html[0];
            
            //Titulo
            $busquedaTituloInicio = 'class="title">';
            $busquedaTituloFin='</h2>';
            $parteTitulo = explode($busquedaTituloInicio, $html);
            
            $parteTitulo = explode($busquedaTituloFin, $parteTitulo[1]);
            $titulo = $parteTitulo[0];

            $elemento = $em -> getRepository('ProjectUserBundle:Noticia') -> findByNombre($titulo);
            if ($elemento) break;

            $busquedaInicio = 'http://www.somosnba.com/wp-content/uploads/';
            $busquedaFin='"';

            $elemento = explode($busquedaInicio, $html);
            $imagen = null;

            if(count($elemento)>1){
            $elemento = explode($busquedaFin, $elemento[1]);
            $imagen = $elemento[0];
            $imagen = $busquedaInicio .$imagen;

            $urlImagen = $imagen;
            $extension = explode(".", $urlImagen);
            $extension = $extension[count($extension) - 1];
            $path = $rutaImagenes;
            $nombreImagen = sha1($urlImagen);

            ini_set('max_execution_time', 300);
            $ch = curl_init($urlImagen);
            $fp = fopen(sprintf('%s/%s.%s', $path, $nombreImagen, $extension), 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            $nombreLimpio = UtilitiesAPI::limpiaNombre($titulo, $class);
            $imagen = new Imagen();
            $imagen -> setNombre($nombreLimpio);
            $imagen -> setTags(UtilitiesAPI::convierteATags($nombreLimpio, $class));
            $imagen -> setPath($nombreImagen . '.' . $extension);
            //$imagen -> setIp($class -> container -> get('request') -> getClientIp());
            $em -> persist($imagen);
            $em -> flush();

            $array['contadorImagenes']++;
    
            }

            
            $busquedaInicio = '/noscript>';
            //$busquedaTituloFin='</h2>';
            $texto = explode($busquedaInicio, $html);
            if(count($texto)>1)$texto = $texto[1];
            else $texto = $texto[0];

            $usuario = $em -> getRepository('ProjectUserBundle:User') -> find(1);

            $object = new Noticia();
            $object -> setFuente($fuente);
            $object -> setUser($usuario);
            $object -> setNombre($titulo);
            if($imagen != null)$object -> setImagen($imagen);
            $object -> setDescripcion($texto);
            $em -> persist($object);
            $em -> flush();

            $array['contadorNoticias']++;
        }

        return $array;
    }

    public static function yogonetLatinoamericaAction($em,$rutaImagenes,$array,$fuente,$class) 
    {

        //$em = $class -> getDoctrine() -> getManager();

        //Ruta del listado de noticias de la web a analizar
        $url = 'http://www.yogonet.com/latinoamerica/';

        //Con la funcion file_get_contents se obtiene todo el html que devuelve la web señalada
        set_time_limit ( 0);
        $htm = file_get_contents($url);
        //Luego de estudiar el codigo fuente de la web, se descubre que todos los elementos de interes
        //Se encuentran dentro del div LATERAL_IZQUIERDO_DETALLE, por ende se hace un explode para poder
        //Obtener los argumentos que esten antes o despues (adentro del div)
        
        //Noticias Principales en <div class="panel-col-top panel-panel">
        $str = 'panel-col-top panel-panel';
        $arr = explode($str, $htm);
        $arr = explode('panel-col-bottom panel-panel', $arr[1]);

        $contenido = $arr[0];

        //var_dump($contenido);exit;

        //Una vez adentro del div de nuestro interes, se observa que todos los enlaces que se necesitan
        //Comienzan por detalle_noticia.php?id=
        $enlaces = explode("\"/latinoamerica/", $contenido);

        //Se hace un explode para obtener todos los codigos html que comiencen justo despues de http://www.apuestas-deportivas.es/pronostico/

        $idNoticias = array();
        //Se realiza un ciclo for para obtener todos los ids de las noticias
        for ($i=1; $i < count($enlaces); $i++) 
        { 
            $cadena = $enlaces[$i];
            //En estas cadenas resultados del ultimo explode hay mas contenido del que nos interesa
            //Un ejemplo de un link es detalle_noticia.php?id=83851" por ende se sabe que el codigo del id
            //termina justo antes de la comilla " para esto se usa strpos para ubicar la posicion y luego extraer el id
            $posicionFinal = strpos($cadena, '"');
            $id = substr($cadena, 0, $posicionFinal);
            //Se comienca en $i-1 porque el primer link que devuelve esta web siempre es vacio y se requieren 
            //son los numeros de los id
            $idNoticias[$i-1] = $id;
        }

        /*
        Para el listado de noticias de sector del juego por cada cuadricula hay 3 enlaces,
        uno en el texto, otro en la imagen y otro en el titulo, por ende despues de buscar los links
        apareceran duplicados, para evitar este problema se usa la funcion array_unique que elimina
        los duplicados, pero conserva las antiguas claves, por esto se debe usar foreach y no un for normal
        */
        $idNoticias = array_unique($idNoticias);
       
        /*
        Se procede a recorrer cada uno de los enlaces para extraer la data y almacenarla en la base de datos
        Se busca recorrer el listado de urls que se genero ejemplo:
        http://sectordeljuego.com/detalle_noticia.php?id=83851
        http://sectordeljuego.com/detalle_noticia.php?id=83850
        http://sectordeljuego.com/detalle_noticia.php?id=83849
        .
        .
        .
        Y asi sucesivamente, se ira recorriendo y obteniendo los textos y descargando una imagen por 
        cada articulo
        */

        foreach ($idNoticias as $key => $value) 
        {
            ini_set('max_execution_time', 300);
            // Tener en cuenta que no es igual la ruta lista_noticias a detalle_noticia
            $urlNoticia = "http://www.yogonet.com/latinoamerica/".$value;
            
            $html = file_get_contents($urlNoticia);
            $busqueda = 'buildmode-full';
            $html = explode($busqueda, $html);
            $html = explode('field-field-fuente', $html[1]);
            $html = $html[0];
            
            //Titulo
            $busquedaTituloInicio = 'field-title-noticia-importada">';
            $busquedaTituloFin='<div id="plugins-sociales">';
            $parteTitulo = explode($busquedaTituloInicio, $html);
            $parteTitulo = explode($busquedaTituloFin, $parteTitulo[1]);
            $titulo = $parteTitulo[0];

            $busquedaTituloInicio = 'field-item">';
            $busquedaTituloFin='</div>';

            $parteTitulo = explode($busquedaTituloInicio, $titulo);
            $parteTitulo = explode($busquedaTituloFin, $parteTitulo[1]);
            $titulo = $parteTitulo[0];

            $elemento = $em -> getRepository('ProjectUserBundle:Noticia') -> findByNombre($titulo);
            if ($elemento) break;

            //echo'<br>'.$titulo;

            $busquedaInicio = 'http://www.yogonet.comlatinoamerica/sites/default/files/noticias/imagenes/';
            $busquedaFin='?';

            $elemento = explode($busquedaInicio, $html);
            $imagen = null;
            if(count($elemento)>1){
            $elemento = explode($busquedaFin, $elemento[1]);
            $imagen = $elemento[0];
            $imagen = $busquedaInicio .$imagen;

            $urlImagen = $imagen;
            $extension = explode(".", $urlImagen);
            $extension = $extension[count($extension) - 1];
            $path = $rutaImagenes;

            
            //$path = 'C:/wamp/www/parseoYogonet/uploads';
            $nombreImagen = sha1($urlImagen);

            ini_set('max_execution_time', 300);
            $ch = curl_init($urlImagen);
            $fp = fopen(sprintf('%s/%s.%s', $path, $nombreImagen, $extension), 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            $nombreLimpio = UtilitiesAPI::limpiaNombre($titulo, $class);
            $imagen = new Imagen();
            $imagen -> setNombre($nombreLimpio);
            $imagen -> setTags(UtilitiesAPI::convierteATags($nombreLimpio, $class));
            $imagen -> setPath($nombreImagen . '.' . $extension);
            //$imagen -> setIp($class -> container -> get('request') -> getClientIp());
            $em -> persist($imagen);
            $em -> flush();

            $array['contadorImagenes']++;
            }

            $busquedaInicio = 'sumario-noticia-importada">';
            $busquedaFin='<div class="field field-type-text field-field-fuente-noticia-importada">';
            $busqueda = explode($busquedaInicio, $html);
            $busqueda = explode($busquedaFin, '<div>'.$busqueda[1]);
            $texto = $busqueda[0];

            $usuario = $em -> getRepository('ProjectUserBundle:User') -> find(1);

            $object = new Noticia();
            $object -> setFuente($fuente);
            $object -> setUser($usuario);
            $object -> setNombre($titulo);
            if($imagen != null)$object -> setImagen($imagen);
            $object -> setDescripcion($texto);
            $em -> persist($object);
            $em -> flush();

            $array['contadorNoticias']++;
        }
        return $array;
    }
    public static function jocPrivatAction($em,$rutaImagenes,$array,$class) {

        //$em = $class -> getDoctrine() -> getManager();
        
        //Ruta del listado de noticias de la web a analizar
        $url = 'http://noticias.jocprivat.com/';

        //Con la funcion file_get_contents se obtiene todo el html que devuelve la web señalada
        $htm = file_get_contents($url);
        //Luego de estudiar el codigo fuente de la web, se descubre que todos los elementos de interes
        //Se encuentran dentro del div LATERAL_IZQUIERDO_DETALLE, por ende se hace un explode para poder
        //Obtener los argumentos que esten antes o despues (adentro del div)
        $str = 'blog-posts hfeed';
        $arr = explode($str, $htm);

        $arr = explode('blog-pager', $arr[1]);



        $contenido = $arr[0];

        //Una vez adentro del div de nuestro interes, se observa que todos los enlaces que se necesitan
        //Comienzan por detalle_noticia.php?id=
        $enlaces = explode("http://noticias.jocprivat.com/2014", $contenido);
        
        /*
        Elly aqui note que tu pagina tiene una caracteristica especial se insertan enlaces que no nos interesan
        ejemplo http://www.sectorgambling.com/category/internacional/ y http://www.sectorgambling.com/author/1stwriter/
        Los enlaces de los articulos siempre comienzan por fecha asi que le coloque 2014
        */

        //Se hace un explode para obtener todos los codigos html que comiencen justo despues de detalle_noticia.php?id=
  
        $idNoticias = array();
        //Se realiza un ciclo for para obtener todos los ids de las noticias
        for ($i=1; $i < count($enlaces); $i++) 
              { 
            $cadena = $enlaces[$i];
            //En estas cadenas resultados del ultimo explode hay mas contenido del que nos interesa
            //Un ejemplo de un link es detalle_noticia.php?id=83851" por ende se sabe que el codigo del id
            //termina justo antes de la comilla " para esto se usa strpos para ubicar la posicion y luego extraer el id
            $posicionFinal = strpos($cadena, "'");
            $id = substr($cadena, 0, $posicionFinal);
            if(strpos($id,'#')==false)$idNoticias[$i-1] = $id;
            //Se comienca en $i-1 porque el primer link que devuelve esta web siempre es vacio y se requieren 
            //son los numeros de los id
            }

            

        /*
        Para el listado de noticias de sector del juego por cada cuadricula hay 3 enlaces,
        uno en el texto, otro en la imagen y otro en el titulo, por ende despues de buscar los links
        apareceran duplicados, para evitar este problema se usa la funcion array_unique que elimina
        los duplicados, pero conserva las antiguas claves, por esto se debe usar foreach y no un for normal
        */
        $idNoticias = array_unique($idNoticias); 

        /*
        Se procede a recorrer cada uno de los enlaces para extraer la data y almacenarla en la base de datos
        Se busca recorrer el listado de urls que se genero ejemplo:
        http://sectordeljuego.com/detalle_noticia.php?id=83851
        http://sectordeljuego.com/detalle_noticia.php?id=83850
        http://sectordeljuego.com/detalle_noticia.php?id=83849
        .
        .
        .
        Y asi sucesivamente, se ira recorriendo y obteniendo los textos y descargando una imagen por 
        cada articulo
        */
        foreach ($idNoticias as $key => $value) {
            ini_set('max_execution_time', 300);  
            // Tener en cuenta que no es igual la ruta lista_noticias a detalle_noticia
            $urlNoticia = "http://noticias.jocprivat.com/2014".$value;

            
            /*A partir de este punto, hay que analizar de nuevo la estructura del codigo
            De una noticia en particular, en el caso de noticias hay que extraer 3 elementos siempre
            Titulo, imagen (descargarla, si hay varias solo la principal) y contenido

            Luego de analizar la data se observa que este caso sencillo, toda la data de interes se encuentra en el div
            <div id="NOTICIA_DETALLE">
            */        
            //Con la funcion file_get_contents se obtiene todo el html que devuelve la web señalada
            $html = file_get_contents($urlNoticia);
            $busqueda = "BlogPosting'>";
            $html = explode($busqueda, $html);

       

            $html = $html[1];
            $html = explode('post-footer', $html);
            $html = $html[0];

           
            
            //$str = '<div id="left-area">';
            //$arr = explode($str, $html);
            

            //Se comienza a extraer los datos de interes, se comienza con el TITULO, el cual se almacena en 
            //<div id="TITULAR_DETALLE">
            $busqueda = "name'>";
            $titulo = explode($busqueda, $html);
            $titulo = explode('</h3>', $titulo[1]);
            $titulo = $titulo[0];
            $titulo = trim($titulo);

            //REVISAR SI EXISTE ESTE ELEMENTO ROMPER EL CICLO PARA NO GUARDAR NOTICIAS REPETIDAS
            $elemento = $em -> getRepository('ProjectUserBundle:Noticia') -> findByNombre($titulo);
            if ($elemento) break;

        
            //Se procede a buscar el contenido el cual se encuentra en <div class="CUERPO_DETALLE">
            $busqueda = "articleBody'>";
            $contenido = explode($busqueda, $html);
            $contenido = explode('<div', $contenido[1]);
            $contenido = $contenido[0];
            $contenido = trim($contenido);
           

            //Se obtienen los datos basicos relacionados con la noticia
            $usuario = $em -> getRepository('ProjectUserBundle:User') -> find(1);
            $fuente = $em -> getRepository('ProjectUserBundle:Fuente') -> find(12);
            
            //Se almacena la noticia
            $object = new Noticia();
            $object -> setFuente($fuente);
            $object -> setUser($usuario);
            $object -> setNombre($titulo);
            //$object -> setImagen($imagen);
            $object -> setDescripcion($contenido);
            $em -> persist($object);
            $em -> flush();

            $array['contadorNoticias']++;

        }

        

       // $array = array('contadorImagenes' => $contadorImagenes, 'contadorPronosticos' => $contadorPronosticos, 'contadorNoticias' => $contadorNoticias);
        return $array;
        
        }



}