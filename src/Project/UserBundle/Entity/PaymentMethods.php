<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PaymentMethods
 *
 * @ORM\Table(name="payment_methods")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\PaymentMethodsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class PaymentMethods
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;


    private $path;


    private $file;
    private $temp;
    private $remove;


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return PaymentMethods
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }




    /**
     * Set path
     *
     * @param string $path
     * @return PaymentMethods
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return strtolower($this -> nombre) . '.jpg';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this -> file = $file;
        // check if we have an old image path
        if (isset($this -> path)) {
            // store the old name to delete after the update
            $this -> temp = $this -> path;
            //$this -> path = null;
        } else {
            $this -> path = 'inicial';
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
            $this -> path = strtolower($this -> nombre) . '.jpg';
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
        $this -> getFile() -> move($this -> getUploadRootDir(), $this -> path);

        // check if we have an old image
        if (isset($this -> temp)) {
            // delete the old image
            //unlink($this -> getUploadRootDir() . '/' . $this -> temp);
            // clear the temp image path
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
        return null === $this -> getPath() ? null : $this -> getUploadRootDir() . '/' . $this -> getPath();
    }

    public function getWebPath() {
        return null === $this -> getPath() ? null : $this -> getUploadDir() . '/' . $this -> getPath();
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this -> getUploadDir();
    }

    protected function getUploadDir() {
        $directorio = 'payment';
        return 'uploads/' . $directorio;
    }

}
