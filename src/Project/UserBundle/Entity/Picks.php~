<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Picks
 *
 * @ORM\Table(name="picks")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\PicksRepository")
 */
class Picks
{
     /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="evento", type="string", length=255, nullable=false)
     */
    private $evento;

    /**
     * @var string
     *
     * @ORM\Column(name="pronostico", type="string", length=255, nullable=false)
     */
    private $pronostico;

    /**
     * @var float
     *
     * @ORM\Column(name="cuota", type="float", nullable=false)
     */
    private $cuota;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="float", nullable=false)
     */
    private $cantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="unidades", type="float", nullable=false)
     */
    private $unidades;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pick_created", type="datetime", nullable=false)
     */
    private $pickCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="stake", type="string", length=255, nullable=false)
     */
    private $stake;

    /**
     * @var string
     *
     * @ORM\Column(name="casa", type="string", length=255, nullable=false)
     */
    private $casa;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var integer
     *
     * @ORM\Column(name="acertado", type="integer", nullable=false)
     */
    private $acertado;

    /**
     * @var integer
     *
     * @ORM\Column(name="pick_foro_id", type="integer", nullable=false)
     */
    private $pickForoId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="deporte", type="integer", nullable=false)
     */
    private $deporte;



    /**
     * Set evento
     *
     * @param string $evento
     * @return Picks
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
     * Set pronostico
     *
     * @param string $pronostico
     * @return Picks
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
     * @param float $cuota
     * @return Picks
     */
    public function setCuota($cuota)
    {
        $this->cuota = $cuota;
    
        return $this;
    }

    /**
     * Get cuota
     *
     * @return float 
     */
    public function getCuota()
    {
        return $this->cuota;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return Picks
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set unidades
     *
     * @param float $unidades
     * @return Picks
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    
        return $this;
    }

    /**
     * Get unidades
     *
     * @return float 
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set pickCreated
     *
     * @param \DateTime $pickCreated
     * @return Picks
     */
    public function setPickCreated($pickCreated)
    {
        $this->pickCreated = $pickCreated;
    
        return $this;
    }

    /**
     * Get pickCreated
     *
     * @return \DateTime 
     */
    public function getPickCreated()
    {
        return $this->pickCreated;
    }

    /**
     * Set stake
     *
     * @param string $stake
     * @return Picks
     */
    public function setStake($stake)
    {
        $this->stake = $stake;
    
        return $this;
    }

    /**
     * Get stake
     *
     * @return string 
     */
    public function getStake()
    {
        return $this->stake;
    }

    /**
     * Set casa
     *
     * @param string $casa
     * @return Picks
     */
    public function setCasa($casa)
    {
        $this->casa = $casa;
    
        return $this;
    }

    /**
     * Get casa
     *
     * @return string 
     */
    public function getCasa()
    {
        return $this->casa;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return Picks
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    
        return $this;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set acertado
     *
     * @param integer $acertado
     * @return Picks
     */
    public function setAcertado($acertado)
    {
        $this->acertado = $acertado;
    
        return $this;
    }

    /**
     * Get acertado
     *
     * @return integer 
     */
    public function getAcertado()
    {
        return $this->acertado;
    }

    /**
     * Set pickForoId
     *
     * @param integer $pickForoId
     * @return Picks
     */
    public function setPickForoId($pickForoId)
    {
        $this->pickForoId = $pickForoId;
    
        return $this;
    }

    /**
     * Get pickForoId
     *
     * @return integer 
     */
    public function getPickForoId()
    {
        return $this->pickForoId;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Picks
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set deporte
     *
     * @param integer $deporte
     * @return Picks
     */
    public function setDeporte($deporte)
    {
        $this->deporte = $deporte;
    
        return $this;
    }

    /**
     * Get deporte
     *
     * @return integer 
     */
    public function getDeporte()
    {
        return $this->deporte;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
