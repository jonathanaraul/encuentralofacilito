<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * LinksBlogs
 *
 * @ORM\Table(name="kblinks_blogs")
 * @ORM\Entity
 */

class LinksBlogs
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="urles", type="string", length=255, nullable=false)
     */
    private $urles;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=false)
     */
    private $website;

    /**
     * @var integer
     *
     * @ORM\Column(name="bookie_id", type="integer", nullable=false)
     */
    private $bookieId;

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
     * Set name
     *
     * @param string $name
     * @return LinksBlogs
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return LinksBlogs
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
     * Set urles
     *
     * @param string $urles
     * @return LinksBlogs
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
     * Set website
     *
     * @param string $website
     * @return LinksBlogs
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set bookieId
     *
     * @param integer $bookieId
     * @return LinksBlogs
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


}
