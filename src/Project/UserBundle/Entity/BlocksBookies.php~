<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * BlocksBookies
 *
 * @ORM\Table(name="blocks_bookies")
 * @ORM\Entity
 */
class BlocksBookies
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="smallint", nullable=false)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="bono", type="string", length=255, nullable=false)
     */
    private $bono;

    /**
     * @var string
     *
     * @ORM\Column(name="urles", type="string", length=255, nullable=false)
     */
    private $urles;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="no_deposit", type="boolean", nullable=false)
     */
    private $noDeposit;

    /**
     * @var string
     *
     * @ORM\Column(name="bono_no_deposit", type="string", length=255, nullable=false)
     */
    private $bonoNoDeposit;

    /**
     * @var string
     *
     * @ORM\Column(name="url_no_deposit", type="string", length=255, nullable=true)
     */
    private $urlNoDeposit;

    /**
     * @var string
     *
     * @ORM\Column(name="urles_no_deposit", type="string", length=255, nullable=true)
     */
    private $urlesNoDeposit;

    /**
     * @var integer
     *
     * @ORM\Column(name="bookie_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookieId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="track_id", type="boolean")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $trackId;



    /**
     * Set active
     *
     * @param boolean $active
     * @return BlocksBookies
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return BlocksBookies
     */
    public function setOrder($order)
    {
        $this->order = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set bono
     *
     * @param string $bono
     * @return BlocksBookies
     */
    public function setBono($bono)
    {
        $this->bono = $bono;
    
        return $this;
    }

    /**
     * Get bono
     *
     * @return string 
     */
    public function getBono()
    {
        return $this->bono;
    }

    /**
     * Set urles
     *
     * @param string $urles
     * @return BlocksBookies
     */
    public function setUrles($urles)
    {
        $this->urles = $urles;
    
        return $this;
    }

    /**
     * Get urles
     *
     * @return string 
     */
    public function getUrles()
    {
        return $this->urles;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return BlocksBookies
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set noDeposit
     *
     * @param boolean $noDeposit
     * @return BlocksBookies
     */
    public function setNoDeposit($noDeposit)
    {
        $this->noDeposit = $noDeposit;
    
        return $this;
    }

    /**
     * Get noDeposit
     *
     * @return boolean 
     */
    public function getNoDeposit()
    {
        return $this->noDeposit;
    }

    /**
     * Set bonoNoDeposit
     *
     * @param string $bonoNoDeposit
     * @return BlocksBookies
     */
    public function setBonoNoDeposit($bonoNoDeposit)
    {
        $this->bonoNoDeposit = $bonoNoDeposit;
    
        return $this;
    }

    /**
     * Get bonoNoDeposit
     *
     * @return string 
     */
    public function getBonoNoDeposit()
    {
        return $this->bonoNoDeposit;
    }

    /**
     * Set urlNoDeposit
     *
     * @param string $urlNoDeposit
     * @return BlocksBookies
     */
    public function setUrlNoDeposit($urlNoDeposit)
    {
        $this->urlNoDeposit = $urlNoDeposit;
    
        return $this;
    }

    /**
     * Get urlNoDeposit
     *
     * @return string 
     */
    public function getUrlNoDeposit()
    {
        return $this->urlNoDeposit;
    }

    /**
     * Set urlesNoDeposit
     *
     * @param string $urlesNoDeposit
     * @return BlocksBookies
     */
    public function setUrlesNoDeposit($urlesNoDeposit)
    {
        $this->urlesNoDeposit = $urlesNoDeposit;
    
        return $this;
    }

    /**
     * Get urlesNoDeposit
     *
     * @return string 
     */
    public function getUrlesNoDeposit()
    {
        return $this->urlesNoDeposit;
    }

    /**
     * Set bookieId
     *
     * @param integer $bookieId
     * @return BlocksBookies
     */
    public function setBookieId($bookieId)
    {
        $this->bookieId = $bookieId;
    
        return $this;
    }

    /**
     * Get bookieId
     *
     * @return integer 
     */
    public function getBookieId()
    {
        return $this->bookieId;
    }

    /**
     * Set trackId
     *
     * @param boolean $trackId
     * @return BlocksBookies
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
    
        return $this;
    }

    /**
     * Get trackId
     *
     * @return boolean 
     */
    public function getTrackId()
    {
        return $this->trackId;
    }
}
