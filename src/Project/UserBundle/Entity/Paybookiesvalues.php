<?php

namespace Project\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Bookies
 *
 * @ORM\Table(name="sf2_pay_bookies_values")
 * @ORM\Entity
 */
class Paybookiesvalues
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
     * @var \Bookies
     *
     * @ORM\ManyToOne(targetEntity="Paysafecardbookies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paysafecardbookies", referencedColumnName="id", nullable=false)
     * })
     */
    private $paysafecardbookies;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

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
     * @return Paybookiesvalues
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
     * Set created
     *
     * @param \DateTime $created
     * @return Paybookiesvalues
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
     * @return Paybookiesvalues
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
     * @return Paybookiesvalues
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
     * Set paysafecardbookies
     *
     * @param \Project\UserBundle\Entity\Paysafecardbookies $paysafecardbookies
     * @return Paybookiesvalues
     */
    public function setPaysafecardbookies(\Project\UserBundle\Entity\Paysafecardbookies $paysafecardbookies)
    {
        $this->paysafecardbookies = $paysafecardbookies;

        return $this;
    }

    /**
     * Get paysafecardbookies
     *
     * @return \Project\UserBundle\Entity\Paysafecardbookies 
     */
    public function getPaysafecardbookies()
    {
        return $this->paysafecardbookies;
    }
}
