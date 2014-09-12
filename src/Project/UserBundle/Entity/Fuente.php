<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Fuente
 *
 * @ORM\Table(name="sf2_fuente")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\FuenteRepository")
 */

class Fuente
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="rss", type="string", length=255, nullable=true)
     */
    private $rss;

    /**
     * @var string
     *
     * @ORM\Column(name="blog", type="string", length=255, nullable=false)
     */
    private $blog;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=true)
     */
    private $published = true;
	
     /**
     * @var \FuenteTipo
     *
     * @ORM\ManyToOne(targetEntity="FuenteTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fuenteTipo", referencedColumnName="id", nullable=false)
     * })
     */
    private $fuenteTipo;

     /**
     * @var \FuenteCategoria
     *
     * @ORM\ManyToOne(targetEntity="FuenteCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fuenteCategoria", referencedColumnName="id", nullable=false)
     * })
     */
    private $fuenteCategoria;

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
     * @return Fuente
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
     * Set url
     *
     * @param string $url
     * @return Fuente
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
     * Set blog
     *
     * @param string $blog
     * @return Fuente
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * Get blog
     *
     * @return string 
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Fuente
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
     * Set created
     *
     * @param \DateTime $created
     * @return Fuente
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
     * @return Fuente
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
     * Set fuenteTipo
     *
     * @param \Project\UserBundle\Entity\FuenteTipo $fuenteTipo
     * @return Fuente
     */
    public function setFuenteTipo(\Project\UserBundle\Entity\FuenteTipo $fuenteTipo)
    {
        $this->fuenteTipo = $fuenteTipo;

        return $this;
    }

    /**
     * Get fuenteTipo
     *
     * @return \Project\UserBundle\Entity\FuenteTipo 
     */
    public function getFuenteTipo()
    {
        return $this->fuenteTipo;
    }

    /**
     * Set fuenteCategoria
     *
     * @param \Project\UserBundle\Entity\FuenteCategoria $fuenteCategoria
     * @return Fuente
     */
    public function setFuenteCategoria(\Project\UserBundle\Entity\FuenteCategoria $fuenteCategoria)
    {
        $this->fuenteCategoria = $fuenteCategoria;

        return $this;
    }

    /**
     * Get fuenteCategoria
     *
     * @return \Project\UserBundle\Entity\FuenteCategoria 
     */
    public function getFuenteCategoria()
    {
        return $this->fuenteCategoria;
    }

    /**
     * Set rss
     *
     * @param string $rss
     * @return Fuente
     */
    public function setRss($rss)
    {
        $this->rss = $rss;

        return $this;
    }

    /**
     * Get rss
     *
     * @return string 
     */
    public function getRss()
    {
        return $this->rss;
    }
}
