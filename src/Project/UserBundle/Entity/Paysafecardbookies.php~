<?php

namespace Project\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Bookies
 *
 * @ORM\Table(name="sf2_paysafecardbookies")
 * @ORM\Entity
 */
class Paysafecardbookies
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bookies")
     * @ORM\JoinTable(name="sf2_pay_bookies",
     *      joinColumns={@ORM\JoinColumn(name="id_paysafecardbookies", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_bookies", referencedColumnName="id")}
     * ) 
     */
    protected $bookies; 

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

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

    public function __construct()
    {
        $this->bookies = new ArrayCollection();
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

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Paysafecardbookies
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
     * Set email
     *
     * @param string $email
     * @return Paysafecardbookies
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
     * Set comentarios
     *
     * @param string $comentarios
     * @return Paysafecardbookies
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
     * @return Paysafecardbookies
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
     * @return Paysafecardbookies
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
     * Set ip
     *
     * @param string $ip
     * @return Paysafecardbookies
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
     * Add bookies
     *
     * @param \Project\UserBundle\Entity\Bookies $bookies
     * @return Paysafecardbookies
     */
    public function addBooky(\Project\UserBundle\Entity\Bookies $bookies)
    {
        $this->bookies[] = $bookies;

        return $this;
    }

    /**
     * Remove bookies
     *
     * @param \Project\UserBundle\Entity\Bookies $bookies
     */
    public function removeBooky(\Project\UserBundle\Entity\Bookies $bookies)
    {
        $this->bookies->removeElement($bookies);
    }

    /**
     * Get bookies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBookies()
    {
        return $this->bookies;
    }
}
