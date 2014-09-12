<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * HelpStepsBookie
 *
 * @ORM\Table(name="sf2_help_steps_bookie")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\HelpStepsBookieRepository")
 * @ORM\HasLifecycleCallbacks
 */
class HelpStepsBookie
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
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text", nullable=false)
     */
    private $texto;

    /**
     * @var string
     *
     * @ORM\Column(name="imagenUrl", type="string", length=255, nullable=false)
     */
    private $imagenUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="bookieId", type="integer", nullable=false)
     */
    private $bookieId;

    /**
     * @var integer
     *
     * @ORM\Column(name="step", type="integer", nullable=false)
     */
    private $step;

    private $file;
    private $temp;
    private $remove;


    /**
     * Set titulo
     *
     * @param string $titulo
     * @return HelpStepsBookie
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return HelpStepsBookie
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    
        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set imagenUrl
     *
     * @param string $imagenUrl
     * @return HelpStepsBookie
     */
    public function setImagenUrl($imagenUrl)
    {
        $this->imagenUrl = $imagenUrl;
    
        return $this;
    }

    /**
     * Get imagenUrl
     *
     * @return string 
     */
    public function getImagenUrl()
    {
        return $this->imagenUrl;
    }

    /**
     * Set bookieId
     *
     * @param integer $bookieId
     * @return HelpStepsBookie
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
     * Set step
     *
     * @param integer $step
     * @return HelpStepsBookie
     */
    public function setStep($step)
    {
        $this->step = $step;
    
        return $this;
    }

    /**
     * Get step
     *
     * @return integer 
     */
    public function getStep()
    {
        return $this->step;
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
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this -> file = $file;
        // check if we have an old image path
        if (isset($this -> imagenUrl)) {
            // store the old name to delete after the update
            $this -> temp = $this -> imagenUrl;
            //$this -> imagenUrl = null;
        } else {
            $this -> imagenUrl = 'inicial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this -> getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this -> imagenUrl = $filename . '.' . $this -> getFile() -> guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this -> getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this -> getFile() -> move($this -> getUploadRootDir(), $this -> imagenUrl);

        // check if we have an old image
        if (isset($this -> temp)) {
            // delete the old image
            //unlink($this -> getUploadRootDir() . '/' . $this -> temp);
            // clear the temp image imagenUrl
            $this -> temp = null;
        }
        $this -> file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this -> getAbsolutePath()) {
            unlink($file);
        }
    }
        /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this -> file;
    }

    public function getAbsolutePath() {
        return null === $this -> imagenUrl ? null : $this -> getUploadRootDir() . '/' . $this -> imagenUrl;
    }

    public function getWebPath() {
        return null === $this -> imagenUrl ? null : $this -> getUploadDir() . '/' . $this -> imagenUrl;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this -> getUploadDir();
    }

    protected function getUploadDir() {
        $directorio = 'bookies_help';
        return 'uploads/' . $directorio;
    }

}
