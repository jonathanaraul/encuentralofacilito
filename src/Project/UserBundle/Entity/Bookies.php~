<?php


namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Bookies
 *
 * @ORM\Table(name="bookies")
 * @ORM\Entity
 */
class Bookies
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
     * @ORM\Column(name="logo", type="string", length=255, nullable=false)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_grande", type="text", nullable=false)
     */
    private $logoGrande;

    /**
     * @var float
     *
     * @ORM\Column(name="valoracion", type="float", precision=10, scale=0, nullable=false)
     */
    private $valoracion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_codificado", type="string", length=255, nullable=false)
     */
    private $nombreCodificado;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="blob", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="bono", type="string", length=10, nullable=false)
     */
    private $bono;

    /**
     * @var string
     *
     * @ORM\Column(name="maximo", type="string", length=10, nullable=false)
     */
    private $maximo;

    /**
     * @var string
     *
     * @ORM\Column(name="condiciones", type="string", length=255, nullable=false)
     */
    private $condiciones;

    /**
     * @var string
     *
     * @ORM\Column(name="deposito_minimo", type="string", length=255, nullable=false)
     */
    private $depositoMinimo;

    /**
     * @var string
     *
     * @ORM\Column(name="apuesta_minima", type="string", length=255, nullable=false)
     */
    private $apuestaMinima;

    /**
     * @var boolean
     *
     * @ORM\Column(name="apuestas_live", type="boolean", nullable=false)
     */
    private $apuestasLive;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="live_chat", type="boolean", nullable=false)
     */
    private $liveChat;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var float
     *
     * @ORM\Column(name="fiabilidad", type="float", precision=10, scale=0, nullable=false)
     */
    private $fiabilidad;

    /**
     * @var float
     *
     * @ORM\Column(name="cuotas", type="float", precision=10, scale=0, nullable=false)
     */
    private $cuotas;

    /**
     * @var float
     *
     * @ORM\Column(name="usabilidad", type="float", precision=10, scale=0, nullable=false)
     */
    private $usabilidad;

    /**
     * @var float
     *
     * @ORM\Column(name="atencion_cliente", type="float", precision=10, scale=0, nullable=false)
     */
    private $atencionCliente;

    /**
     * @var float
     *
     * @ORM\Column(name="pagos", type="float", precision=10, scale=0, nullable=false)
     */
    private $pagos;

    /**
     * @var integer
     *
     * @ORM\Column(name="ranking", type="integer", nullable=false)
     */
    private $ranking;

    /**
     * @var boolean
     *
     * @ORM\Column(name="patrocinador", type="boolean", nullable=false)
     */
    private $patrocinador;

    /**
     * @var boolean
     *
     * @ORM\Column(name="orden_casas", type="boolean", nullable=false)
     */
    private $ordenCasas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="licencia_esp", type="boolean", nullable=false)
     */
    private $licenciaEsp;

    private $file;
    private $temp;
    private $remove;


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
     * Set logo
     *
     * @param string $logo
     * @return Bookies
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Bookies
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
     * Set logoGrande
     *
     * @param string $logoGrande
     * @return Bookies
     */
    public function setLogoGrande($logoGrande)
    {
        $this->logoGrande = $logoGrande;

        return $this;
    }

    /**
     * Get logoGrande
     *
     * @return string 
     */
    public function getLogoGrande()
    {
        return $this->logoGrande;
    }

    /**
     * Set valoracion
     *
     * @param float $valoracion
     * @return Bookies
     */
    public function setValoracion($valoracion)
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    /**
     * Get valoracion
     *
     * @return float 
     */
    public function getValoracion()
    {
        return $this->valoracion;
    }

    /**
     * Set nombreCodificado
     *
     * @param string $nombreCodificado
     * @return Bookies
     */
    public function setNombreCodificado($nombreCodificado)
    {
        $this->nombreCodificado = $nombreCodificado;

        return $this;
    }

    /**
     * Get nombreCodificado
     *
     * @return string 
     */
    public function getNombreCodificado()
    {
        return $this->nombreCodificado;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Bookies
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set bono
     *
     * @param string $bono
     * @return Bookies
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
     * Set maximo
     *
     * @param string $maximo
     * @return Bookies
     */
    public function setMaximo($maximo)
    {
        $this->maximo = $maximo;

        return $this;
    }

    /**
     * Get maximo
     *
     * @return string 
     */
    public function getMaximo()
    {
        return $this->maximo;
    }

    /**
     * Set condiciones
     *
     * @param string $condiciones
     * @return Bookies
     */
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;

        return $this;
    }

    /**
     * Get condiciones
     *
     * @return string 
     */
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Set depositoMinimo
     *
     * @param string $depositoMinimo
     * @return Bookies
     */
    public function setDepositoMinimo($depositoMinimo)
    {
        $this->depositoMinimo = $depositoMinimo;

        return $this;
    }

    /**
     * Get depositoMinimo
     *
     * @return string 
     */
    public function getDepositoMinimo()
    {
        return $this->depositoMinimo;
    }

    /**
     * Set apuestaMinima
     *
     * @param string $apuestaMinima
     * @return Bookies
     */
    public function setApuestaMinima($apuestaMinima)
    {
        $this->apuestaMinima = $apuestaMinima;

        return $this;
    }

    /**
     * Get apuestaMinima
     *
     * @return string 
     */
    public function getApuestaMinima()
    {
        return $this->apuestaMinima;
    }

    /**
     * Set apuestasLive
     *
     * @param boolean $apuestasLive
     * @return Bookies
     */
    public function setApuestasLive($apuestasLive)
    {
        $this->apuestasLive = $apuestasLive;

        return $this;
    }

    /**
     * Get apuestasLive
     *
     * @return boolean 
     */
    public function getApuestasLive()
    {
        return $this->apuestasLive;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Bookies
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
     * Set liveChat
     *
     * @param boolean $liveChat
     * @return Bookies
     */
    public function setLiveChat($liveChat)
    {
        $this->liveChat = $liveChat;

        return $this;
    }

    /**
     * Get liveChat
     *
     * @return boolean 
     */
    public function getLiveChat()
    {
        return $this->liveChat;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Bookies
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Bookies
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
     * Set fiabilidad
     *
     * @param float $fiabilidad
     * @return Bookies
     */
    public function setFiabilidad($fiabilidad)
    {
        $this->fiabilidad = $fiabilidad;

        return $this;
    }

    /**
     * Get fiabilidad
     *
     * @return float 
     */
    public function getFiabilidad()
    {
        return $this->fiabilidad;
    }

    /**
     * Set cuotas
     *
     * @param float $cuotas
     * @return Bookies
     */
    public function setCuotas($cuotas)
    {
        $this->cuotas = $cuotas;

        return $this;
    }

    /**
     * Get cuotas
     *
     * @return float 
     */
    public function getCuotas()
    {
        return $this->cuotas;
    }

    /**
     * Set usabilidad
     *
     * @param float $usabilidad
     * @return Bookies
     */
    public function setUsabilidad($usabilidad)
    {
        $this->usabilidad = $usabilidad;

        return $this;
    }

    /**
     * Get usabilidad
     *
     * @return float 
     */
    public function getUsabilidad()
    {
        return $this->usabilidad;
    }

    /**
     * Set atencionCliente
     *
     * @param float $atencionCliente
     * @return Bookies
     */
    public function setAtencionCliente($atencionCliente)
    {
        $this->atencionCliente = $atencionCliente;

        return $this;
    }

    /**
     * Get atencionCliente
     *
     * @return float 
     */
    public function getAtencionCliente()
    {
        return $this->atencionCliente;
    }

    /**
     * Set pagos
     *
     * @param float $pagos
     * @return Bookies
     */
    public function setPagos($pagos)
    {
        $this->pagos = $pagos;

        return $this;
    }

    /**
     * Get pagos
     *
     * @return float 
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * Set ranking
     *
     * @param integer $ranking
     * @return Bookies
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * Get ranking
     *
     * @return integer 
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Set patrocinador
     *
     * @param boolean $patrocinador
     * @return Bookies
     */
    public function setPatrocinador($patrocinador)
    {
        $this->patrocinador = $patrocinador;

        return $this;
    }

    /**
     * Get patrocinador
     *
     * @return boolean 
     */
    public function getPatrocinador()
    {
        return $this->patrocinador;
    }

    /**
     * Set ordenCasas
     *
     * @param boolean $ordenCasas
     * @return Bookies
     */
    public function setOrdenCasas($ordenCasas)
    {
        $this->ordenCasas = $ordenCasas;

        return $this;
    }

    /**
     * Get ordenCasas
     *
     * @return boolean 
     */
    public function getOrdenCasas()
    {
        return $this->ordenCasas;
    }

    /**
     * Set licenciaEsp
     *
     * @param boolean $licenciaEsp
     * @return Bookies
     */
    public function setLicenciaEsp($licenciaEsp)
    {
        $this->licenciaEsp = $licenciaEsp;

        return $this;
    }

    /**
     * Get licenciaEsp
     *
     * @return boolean 
     */
    public function getLicenciaEsp()
    {
        return $this->licenciaEsp;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this -> file = $file;
        // check if we have an old image path
        if (isset($this -> logo)) {
            // store the old name to delete after the update
            $this -> temp = $this -> logo;
            //$this -> logo = null;
        } else {
            $this -> logo = 'inicial';
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
            $this -> logo = $filename . '.' . $this -> getFile() -> guessExtension();
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
        $this -> getFile() -> move($this -> getUploadRootDir(), $this -> logo);

        // check if we have an old image
        if (isset($this -> temp)) {
            // delete the old image
            //unlink($this -> getUploadRootDir() . '/' . $this -> temp);
            // clear the temp image logo
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
        return null === $this -> logo ? null : $this -> getUploadRootDir() . '/' . $this -> logo;
    }

    public function getWebPath() {
        return null === $this -> logo ? null : $this -> getUploadDir() . '/' . $this -> logo;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this -> getUploadDir();
    }

    protected function getUploadDir() {
        $directorio = 'images/bookies';
        return 'uploads/' . $directorio;
    }

}
