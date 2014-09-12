<?php

namespace Project\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Bookies
 *
 * @ORM\Table(name="sf2_paysafecard")
 * @ORM\Entity
 */
class Paysafecard
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
     * @var \Bookies
     *
     * @ORM\ManyToOne(targetEntity="Bookies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bookies", referencedColumnName="id", nullable=false)
     * })
     */
    private $bookies;

    /**
     * @var string
     *
     * @ORM\Column(name="nick", type="string", length=255, nullable=true)
     */
    private $nick;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var float
     *
     * @ORM\Column(name="desposito", type="float", nullable=false)
     */
    private $desposito;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaDeposito", type="datetime", nullable=true)
     */
    private $fechaDeposito;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nickUsuario", type="string", length=255, nullable=true)
     */
    private $nickUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="emailUsuario", type="string", length=255, nullable=true)
     */
    private $emailUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAcreditacion", type="datetime", nullable=true)
     */
    private $fechaAcreditacion;

   /**
     * @var boolean
     *
     * @ORM\Column(name="acreditado", type="boolean", nullable=false)
     */
    private $acreditado = false;

   /**
     * @var boolean
     *
     * @ORM\Column(name="acreditadoReferido", type="boolean", nullable=false)
     */
    private $acreditadoReferido = false;

    /**
     * @var string
     *
     * @ORM\Column(name="comentarios", type="text", nullable=true)
     */
    private $comentarios;

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
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=false)
     */
    private $ip;

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
     * Set nick
     *
     * @param string $nick
     * @return Paysafecard
     */
    public function setNick($nick)
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * Get nick
     *
     * @return string 
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Paysafecard
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set desposito
     *
     * @param float $desposito
     * @return Paysafecard
     */
    public function setDesposito($desposito)
    {
        $this->desposito = $desposito;

        return $this;
    }

    /**
     * Get desposito
     *
     * @return float 
     */
    public function getDesposito()
    {
        return $this->desposito;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Paysafecard
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaDeposito
     *
     * @param \DateTime $fechaDeposito
     * @return Paysafecard
     */
    public function setFechaDeposito($fechaDeposito)
    {
        $this->fechaDeposito = $fechaDeposito;

        return $this;
    }

    /**
     * Get fechaDeposito
     *
     * @return \DateTime 
     */
    public function getFechaDeposito()
    {
        return $this->fechaDeposito;
    }

    /**
     * Set nickUsuario
     *
     * @param string $nickUsuario
     * @return Paysafecard
     */
    public function setNickUsuario($nickUsuario)
    {
        $this->nickUsuario = $nickUsuario;

        return $this;
    }

    /**
     * Get nickUsuario
     *
     * @return string 
     */
    public function getNickUsuario()
    {
        return $this->nickUsuario;
    }

    /**
     * Set emailUsuario
     *
     * @param string $emailUsuario
     * @return Paysafecard
     */
    public function setEmailUsuario($emailUsuario)
    {
        $this->emailUsuario = $emailUsuario;

        return $this;
    }

    /**
     * Get emailUsuario
     *
     * @return string 
     */
    public function getEmailUsuario()
    {
        return $this->emailUsuario;
    }

    /**
     * Set fechaAcreditacion
     *
     * @param \DateTime $fechaAcreditacion
     * @return Paysafecard
     */
    public function setFechaAcreditacion($fechaAcreditacion)
    {
        $this->fechaAcreditacion = $fechaAcreditacion;

        return $this;
    }

    /**
     * Get fechaAcreditacion
     *
     * @return \DateTime 
     */
    public function getFechaAcreditacion()
    {
        return $this->fechaAcreditacion;
    }

    /**
     * Set acreditado
     *
     * @param boolean $acreditado
     * @return Paysafecard
     */
    public function setAcreditado($acreditado)
    {
        $this->acreditado = $acreditado;

        return $this;
    }

    /**
     * Get acreditado
     *
     * @return boolean 
     */
    public function getAcreditado()
    {
        return $this->acreditado;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     * @return Paysafecard
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Paysafecard
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
     * @return Paysafecard
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
     * Set bookies
     *
     * @param \Project\UserBundle\Entity\Bookies $bookies
     * @return Paysafecard
     */
    public function setBookies(\Project\UserBundle\Entity\Bookies $bookies)
    {
        $this->bookies = $bookies;

        return $this;
    }

    /**
     * Get bookies
     *
     * @return \Project\UserBundle\Entity\Bookies 
     */
    public function getBookies()
    {
        return $this->bookies;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Paysafecard
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set acreditadoReferido
     *
     * @param boolean $acreditadoReferido
     * @return Paysafecard
     */
    public function setAcreditadoReferido($acreditadoReferido)
    {
        $this->acreditadoReferido = $acreditadoReferido;

        return $this;
    }

    /**
     * Get acreditadoReferido
     *
     * @return boolean 
     */
    public function getAcreditadoReferido()
    {
        return $this->acreditadoReferido;
    }
}
