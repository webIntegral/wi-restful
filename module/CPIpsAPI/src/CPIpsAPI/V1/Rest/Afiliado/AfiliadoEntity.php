<?php
namespace CPIpsAPI\V1\Rest\Afiliado;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="CPIpsAPI\V1\Rest\Afiliado\AfiliadoCollection")
 * @ORM\Table(name="wcp_afiliados")
 * @Gedmo\SoftDeleteable(fieldName="deleted", timeAware=false)
 */
class AfiliadoEntity
{

    /**
     *
     * @var int @ORM\Id
     *      @ORM\Column(type="integer")
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $idTrabajador;

    /**
     *
     * @var string @ORM\Column(type="integer", nullable=true)
     */
    protected $tidTrabajador;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $idBeneficiario;

    /**
     *
     * @var string @ORM\Column(type="integer", nullable=true)
     */
    protected $tidBeneficiario;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $nuip;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $caja;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $pos;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $pc;

    /**
     *
     * @var string @ORM\Column(type="integer", nullable=true)
     */
    protected $edad;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $nombre;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $apellido;

    /**
     * Original field for "Fecha de Nacimiento".
     * Keep it for future reference
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $fnac;

    /**
     *
     * @var \DateTime @ORM\Column(type="datetime")
     */
    protected $fechaNacimiento = "1900-01-01 00:00:00";

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $sexo;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $nit;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $sede;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $estrato;

    /**
     * Original field for "Fecha de Asignación".
     * Keep it for future reference
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $fmarc;

    /**
     *
     * @var \DateTime @ORM\Column(type="datetime")
     */
    protected $fechaAsignacion = "1900-01-01 00:00:00";

    /**
     * Original field for "Fecha de Afiliación".
     * Keep it for future reference
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $fafil;

    /**
     *
     * @var \DateTime @ORM\Column(type="datetime")
     */
    protected $fechaAfiliacion = "1900-01-01 00:00:00";

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $cotizante;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $direccionCotizante;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $telefonoCotizante;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $regimen;

    /**
     *
     * @var string @ORM\Column(type="string")
     */
    protected $tipoPaciente = '2';  // Afiliado

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $movil;

    /**
     * Deletion datetime
     *
     * @var \DateTime @ORM\Column(type="datetime", nullable=true)
     */
    protected $deleted;

    /**
     * Creation datetime
     *
     * @var \DateTime @Gedmo\Timestampable(on="create")
     *      @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * Update datetime
     *
     * @var \DateTime @Gedmo\Timestampable(on="update")
     *      @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     *
     * @var ArrayCollection; @ORM\OneToMany(targetEntity="CPIpsAPI\V1\Rest\Examen\ExamenEntity", mappedBy="afiliado")
     */
    protected $examenes;

    /**
     * Initialize collections
     */
    public function __construct()
    {
        $this->examenes = new ArrayCollection();
    }

    /**
     *
     * @param Collection $examenes            
     */
    public function addExamenes(Collection $examenes)
    {
        foreach ($examenes as $examen) {
            $examen->setAfiliado($this);
            $this->examenes->add($examen);
        }
    }

    /**
     *
     * @param Collection $examenes            
     */
    public function removeExamenes(Collection $examenes)
    {
        foreach ($examenes as $examen) {
            $examen->setAfiliado($this);
            $this->examenes->removeElement($examen);
        }
    }

    /**
     *
     * @return the $examenes
     */
    public function getExamenes()
    {
        return $this->examenes;
    }

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param int $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return the $idTrabajador
     */
    public function getIdTrabajador()
    {
        return $this->idTrabajador;
    }

    /**
     *
     * @param string $idTrabajador            
     */
    public function setIdTrabajador($idTrabajador)
    {
        $this->idTrabajador = $idTrabajador;
    }

    /**
     *
     * @return the $tidTrabajador
     */
    public function getTidTrabajador()
    {
        return $this->tidTrabajador;
    }

    /**
     *
     * @param string $tidTrabajador            
     */
    public function setTidTrabajador($tidTrabajador)
    {
        $this->tidTrabajador = $tidTrabajador;
    }

    /**
     *
     * @return the $idBeneficiario
     */
    public function getIdBeneficiario()
    {
        return $this->idBeneficiario;
    }

    /**
     *
     * @param string $idBeneficiario            
     */
    public function setIdBeneficiario($idBeneficiario)
    {
        $this->idBeneficiario = $idBeneficiario;
    }

    /**
     *
     * @return the $tidBeneficiario
     */
    public function getTidBeneficiario()
    {
        return $this->tidBeneficiario;
    }

    /**
     *
     * @param string $tidBeneficiario            
     */
    public function setTidBeneficiario($tidBeneficiario)
    {
        $this->tidBeneficiario = $tidBeneficiario;
    }

    /**
     *
     * @return the $nuip
     */
    public function getNuip()
    {
        return $this->nuip;
    }

    /**
     *
     * @param string $nuip            
     */
    public function setNuip($nuip)
    {
        $this->nuip = $nuip;
    }

    /**
     *
     * @return the $caja
     */
    public function getCaja()
    {
        return $this->caja;
    }

    /**
     *
     * @param string $caja            
     */
    public function setCaja($caja)
    {
        $this->caja = $caja;
    }

    /**
     *
     * @return the $pos
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     *
     * @param string $pos            
     */
    public function setPos($pos)
    {
        $this->pos = $pos;
    }

    /**
     *
     * @return the $pc
     */
    public function getPc()
    {
        return $this->pc;
    }

    /**
     *
     * @param string $pc            
     */
    public function setPc($pc)
    {
        $this->pc = $pc;
    }

    /**
     *
     * @return the $edad
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     *
     * @param string $edad            
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    /**
     *
     * @return the $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     *
     * @param string $nombre            
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     *
     * @return the $apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     *
     * @param string $apellido            
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     *
     * @return the $fnac
     */
    public function getFnac()
    {
        return $this->fnac;
    }

    /**
     *
     * @param string $fnac            
     */
    public function setFnac($fnac)
    {
        $this->fnac = $fnac;
    }

    /**
     *
     * @return the $fechaNacimiento
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     *
     * @param DateTime $fechaNacimiento            
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        // Sets date from format like '2015-05-22 18:55:02'
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $fechaNacimiento['date']);
        $this->fechaNacimiento = $date;
    }

    /**
     *
     * @return the $sexo
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     *
     * @param string $sexo            
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     *
     * @return the $nit
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     *
     * @param string $nit            
     */
    public function setNit($nit)
    {
        $this->nit = $nit;
    }

    /**
     *
     * @return the $sede
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     *
     * @param string $sede            
     */
    public function setSede($sede)
    {
        $this->sede = $sede;
    }

    /**
     *
     * @return the $estrato
     */
    public function getEstrato()
    {
        return $this->estrato;
    }

    /**
     *
     * @param string $estrato            
     */
    public function setEstrato($estrato)
    {
        $this->estrato = $estrato;
    }

    /**
     *
     * @return the $fmarc
     */
    public function getFmarc()
    {
        return $this->fmarc;
    }

    /**
     *
     * @param string $fmarc            
     */
    public function setFmarc($fmarc)
    {
        $this->fmarc = $fmarc;
    }

    /**
     *
     * @return the $fechaAsignacion
     */
    public function getFechaAsignacion()
    {
        return $this->fechaAsignacion;
    }

    /**
     *
     * @param DateTime $fechaAsignacion            
     */
    public function setFechaAsignacion($fechaAsignacion)
    {
        // Sets date from format like '2015-05-22 18:55:02'
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $fechaAsignacion['date']);
        $this->fechaAsignacion = $date;
    }

    /**
     *
     * @return the $fafil
     */
    public function getFafil()
    {
        return $this->fafil;
    }

    /**
     *
     * @param string $fafil            
     */
    public function setFafil($fafil)
    {
        $this->fafil = $fafil;
    }

    /**
     *
     * @return the $fechaAfiliacion
     */
    public function getFechaAfiliacion()
    {
        return $this->fechaAfiliacion;
    }

    /**
     *
     * @param DateTime $fechaAfiliacion            
     */
    public function setFechaAfiliacion($fechaAfiliacion)
    {
        // Sets date from format like '2015-05-22 18:55:02'
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $fechaAfiliacion['date']);
        $this->fechaAfiliacion = $date;
    }

    /**
     *
     * @return the $cotizante
     */
    public function getCotizante()
    {
        return $this->cotizante;
    }

    /**
     *
     * @param string $cotizante            
     */
    public function setCotizante($cotizante)
    {
        $this->cotizante = $cotizante;
    }

    /**
     *
     * @return the $direccionCotizante
     */
    public function getDireccionCotizante()
    {
        return $this->direccionCotizante;
    }

    /**
     *
     * @param string $direccionCotizante            
     */
    public function setDireccionCotizante($direccionCotizante)
    {
        $this->direccionCotizante = $direccionCotizante;
    }

    /**
     *
     * @return the $telefonoCotizante
     */
    public function getTelefonoCotizante()
    {
        return $this->telefonoCotizante;
    }

    /**
     *
     * @param string $telefonoCotizante            
     */
    public function setTelefonoCotizante($telefonoCotizante)
    {
        $this->telefonoCotizante = $telefonoCotizante;
    }

    /**
     *
     * @return the $regimen
     */
    public function getRegimen()
    {
        return $this->regimen;
    }

    /**
     *
     * @param string $regimen            
     */
    public function setRegimen($regimen)
    {
        $this->regimen = $regimen;
    }

    /**
     *
     * @return the $tipoPaciente
     */
    public function getTipoPaciente()
    {
        return $this->tipoPaciente;
    }

    /**
     *
     * @param string $tipoPaciente            
     */
    public function setTipoPaciente($tipoPaciente)
    {
        $this->tipoPaciente = $tipoPaciente;
    }

    /**
     *
     * @return the $movil
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     *
     * @param string $movil            
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    }

    /**
     *
     * @return the $deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     *
     * @param DateTime $deleted            
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     *
     * @return the $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     *
     * @return the $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     *
     * @see Zend\\Stdlib\\Hydrator\\ArraySerializable::extract expects the provided object to implement getArrayCopy()
     * @return multitype
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}