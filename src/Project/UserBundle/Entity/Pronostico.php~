<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Pronostico
 *
 * @ORM\Table(name="sf2_pronostico")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\PronosticoRepository")
 * @ORM\HasLifecycleCallbacks
 */

class Pronostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=true)
     */
    private $published = true;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = 0;
	
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="evento", type="string", length=255, nullable=false)
     */
    private $evento;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=255, nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="pronostico", type="string", length=255, nullable=false)
     */
    private $pronostico;

    /**
     * @var string
     *
     * @ORM\Column(name="casaApuestas", type="string", length=255, nullable=false)
     */
    private $casaApuestas;

    /**
     * @var float
     *
     * @ORM\Column(name="cuota", type="float", nullable=false)
     */
    private $cuota;

    /**
     * @var string
     *
     * @ORM\Column(name="skate", type="string", nullable=false)
     */
    private $skate;

     /**
     * @var \Imagen
     *
     * @ORM\ManyToOne(targetEntity="Imagen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="imagen", referencedColumnName="id", nullable=true)
     * })
     */
    private $imagen;

     /**
     * @var \Fuente
     *
     * @ORM\ManyToOne(targetEntity="Fuente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fuente", referencedColumnName="id", nullable=false)
     * })
     */
    private $fuente;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;
    
    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPublicacion", type="datetime", nullable=true)
     */
    private $fechaPublicacion;

     /**
     * @var \Acceso
     *
     * @ORM\ManyToOne(targetEntity="Acceso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acceso", referencedColumnName="id", nullable=true)
     * })
     */
    private $acceso;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Pronostico
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Pronostico
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Pronostico
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set evento
     *
     * @param string $evento
     * @return Pronostico
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento
     *
     * @return string 
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     * @return Pronostico
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set pronostico
     *
     * @param string $pronostico
     * @return Pronostico
     */
    public function setPronostico($pronostico)
    {
        $this->pronostico = $pronostico;

        return $this;
    }

    /**
     * Get pronostico
     *
     * @return string 
     */
    public function getPronostico()
    {
        return $this->pronostico;
    }

    /**
     * Set cuota
     *
     * @param integer $cuota
     * @return Pronostico
     */
    public function setCuota($cuota)
    {
        $this->cuota = $cuota;

        return $this;
    }

    /**
     * Get cuota
     *
     * @return integer 
     */
    public function getCuota()
    {
        return $this->cuota;
    }

    /**
     * Set skate
     *
     * @param integer $skate
     * @return Pronostico
     */
    public function setSkate($skate)
    {
        $this->skate = $skate;

        return $this;
    }

    /**
     * Get skate
     *
     * @return integer 
     */
    public function getSkate()
    {
        return $this->skate;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Pronostico
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Pronostico
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set fuente
     *
     * @param \Project\UserBundle\Entity\Fuente $fuente
     * @return Pronostico
     */
    public function setFuente(\Project\UserBundle\Entity\Fuente $fuente)
    {
        $this->fuente = $fuente;

        return $this;
    }

    /**
     * Get fuente
     *
     * @return \Project\UserBundle\Entity\Fuente 
     */
    public function getFuente()
    {
        return $this->fuente;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Pronostico
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set casaApuestas
     *
     * @param string $casaApuestas
     * @return Pronostico
     */
    public function setCasaApuestas($casaApuestas)
    {
        $this->casaApuestas = $casaApuestas;

        return $this;
    }

    /**
     * Get casaApuestas
     *
     * @return string 
     */
    public function getCasaApuestas()
    {
        return $this->casaApuestas;
    }

    /**
     * Set imagen
     *
     * @param \Project\UserBundle\Entity\Imagen $imagen
     * @return Pronostico
     */
    public function setImagen(\Project\UserBundle\Entity\Imagen $imagen = null)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return \Project\UserBundle\Entity\Imagen 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set user
     *
     * @param \Project\UserBundle\Entity\User $user
     * @return Pronostico
     */
    public function setUser(\Project\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Project\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     * @return Pronostico
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime 
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }



    /**
     * Set acceso
     *
     * @param \Project\UserBundle\Entity\Acceso $acceso
     * @return Pronostico
     */
    public function setAcceso(\Project\UserBundle\Entity\Acceso $acceso = null)
    {
        $this->acceso = $acceso;

        return $this;
    }

    /**
     * Get acceso
     *
     * @return \Project\UserBundle\Entity\Acceso 
     */
    public function getAcceso()
    {
        return $this->acceso;
    }
}
