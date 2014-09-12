<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AccountBookie
 *
 * @ORM\Table(name="sf2_account_bookie")
 * @ORM\Entity
 */
class AccountBookie
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="bookie", type="integer", nullable=false)
     */
    private $bookie;

    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=255, nullable=false)
     */
    private $account;

    /**
     * @var float
     *
     * @ORM\Column(name="depositado", type="float", nullable=false)
     */
    private $depositado;

    /**
     * @var float
     *
     * @ORM\Column(name="dinero_actual", type="float", nullable=false)
     */
    private $dineroActual;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bono", type="boolean", nullable=false)
     */
    private $bono;

    /**
     * @var string
     *
     * @ORM\Column(name="rollover", type="string", length=255, nullable=false)
     */
    private $rollover;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad_bono", type="float", nullable=false)
     */
    private $cantidadBono;

    /**
     * @var float
     *
     * @ORM\Column(name="ganancias", type="float", nullable=false)
     */
    private $ganancias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="status_time", type="datetime", nullable=false)
     */
    private $statusTime;





    /**
     * Set userId
     *
     * @param integer $userId
     * @return Sf2AccountBookie
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set bookie
     *
     * @param integer $bookie
     * @return Sf2AccountBookie
     */
    public function setBookie($bookie)
    {
        $this->bookie = $bookie;
    
        return $this;
    }

    /**
     * Get bookie
     *
     * @return integer 
     */
    public function getBookie()
    {
        return $this->bookie;
    }

    /**
     * Set account
     *
     * @param string $account
     * @return Sf2AccountBookie
     */
    public function setAccount($account)
    {
        $this->account = $account;
    
        return $this;
    }

    /**
     * Get account
     *
     * @return string 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set depositado
     *
     * @param float $depositado
     * @return Sf2AccountBookie
     */
    public function setDepositado($depositado)
    {
        $this->depositado = $depositado;
    
        return $this;
    }

    /**
     * Get depositado
     *
     * @return float 
     */
    public function getDepositado()
    {
        return $this->depositado;
    }

    /**
     * Set dineroActual
     *
     * @param float $dineroActual
     * @return Sf2AccountBookie
     */
    public function setDineroActual($dineroActual)
    {
        $this->dineroActual = $dineroActual;
    
        return $this;
    }

    /**
     * Get dineroActual
     *
     * @return float 
     */
    public function getDineroActual()
    {
        return $this->dineroActual;
    }

    /**
     * Set bono
     *
     * @param boolean $bono
     * @return Sf2AccountBookie
     */
    public function setBono($bono)
    {
        $this->bono = $bono;
    
        return $this;
    }

    /**
     * Get bono
     *
     * @return boolean 
     */
    public function getBono()
    {
        return $this->bono;
    }

    /**
     * Set rollover
     *
     * @param string $rollover
     * @return Sf2AccountBookie
     */
    public function setRollover($rollover)
    {
        $this->rollover = $rollover;
    
        return $this;
    }

    /**
     * Get rollover
     *
     * @return string 
     */
    public function getRollover()
    {
        return $this->rollover;
    }

    /**
     * Set cantidadBono
     *
     * @param float $cantidadBono
     * @return Sf2AccountBookie
     */
    public function setCantidadBono($cantidadBono)
    {
        $this->cantidadBono = $cantidadBono;
    
        return $this;
    }

    /**
     * Get cantidadBono
     *
     * @return float 
     */
    public function getCantidadBono()
    {
        return $this->cantidadBono;
    }

    /**
     * Set ganancias
     *
     * @param float $ganancias
     * @return Sf2AccountBookie
     */
    public function setGanancias($ganancias)
    {
        $this->ganancias = $ganancias;
    
        return $this;
    }

    /**
     * Get ganancias
     *
     * @return float 
     */
    public function getGanancias()
    {
        return $this->ganancias;
    }

    /**
     * Set statusTime
     *
     * @param \DateTime $statusTime
     * @return Sf2AccountBookie
     */
    public function setStatusTime($statusTime)
    {
        $this->statusTime = $statusTime;
    
        return $this;
    }

    /**
     * Get statusTime
     *
     * @return \DateTime 
     */
    public function getStatusTime()
    {
        return $this->statusTime;
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
