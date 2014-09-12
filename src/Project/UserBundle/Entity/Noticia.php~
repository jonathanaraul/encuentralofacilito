<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Noticia
 *
 * @ORM\Table(name="sf2_noticia")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\NoticiaRepository")
 * @ORM\HasLifecycleCallbacks
 */

class Noticia
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
     * @var \Acceso
     *
     * @ORM\ManyToOne(targetEntity="Acceso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acceso", referencedColumnName="id", nullable=true)
     * })
     */
    private $acceso;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

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
     * @return Noticia
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
     * @return Noticia
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
     * @return Noticia
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
     * Set created
     *
     * @param \DateTime $created
     * @return Noticia
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
     * @return Noticia
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
     * Set video
     *
     * @param string $video
     * @return Noticia
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set imagen
     *
     * @param \Project\UserBundle\Entity\Imagen $imagen
     * @return Noticia
     */
    public function setImagen(\Project\UserBundle\Entity\Imagen $imagen)
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
     * Set estado
     *
     * @param integer $estado
     * @return Noticia
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
     * Set fuente
     *
     * @param \Project\UserBundle\Entity\Fuente $fuente
     * @return Noticia
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
     * Set user
     *
     * @param \Project\UserBundle\Entity\User $user
     * @return Noticia
     */
    public function setUser(\Project\UserBundle\Entity\User $user = null)
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
     * @return Noticia
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
     * @return Noticia
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
