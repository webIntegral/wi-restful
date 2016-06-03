<?php
namespace CPIpsAPI\V1\Rest\Medico;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="CPIpsAPI\V1\Rest\Medico\MedicoCollection")
 * @ORM\Table(name="wcp_medicos")
 * @Gedmo\SoftDeleteable(fieldName="deleted", timeAware=false)
 */
class MedicoEntity
{

    /**
     *
     * @var int @ORM\Id
     *      @ORM\Column(type="integer")
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /*
     * Consultar con Danny
     * @todo: Nombre y teléfono deberían hacer parte de una entidad que se
     * llame contacto o persona, donde también estén los afiliados y demás personas
     * que se requieran.
     */
    
    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $nombre;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $telefono;
    
    /*
     * Consultar con Danny
     * @todo: La especialidad debería de ser una entidad por si misma.
     */
    
    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $especialidad;

    /**
     *
     * @var boolean @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo = true;

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
     * @var ArrayCollection;
     * @ORM\OneToMany(targetEntity="CPIpsAPI\V1\Rest\Examen\ExamenEntity", mappedBy="medico")
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
     * @return the $telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     *
     * @param string $telefono            
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     *
     * @return the $especialidad
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     *
     * @param string $especialidad            
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;
    }

    /**
     *
     * @return the $activo
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     *
     * @param boolean $activo            
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
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
     * @param Collection $examenes
     */
    public function addExamenes(Collection $examenes)
    {
        foreach ($examenes as $examen) {
            $examen->setMedico($this);
            $this->examenes->add($examen);
        }
    }
    
    /**
     * @param Collection $examenes
     */
    public function removeExamenes(Collection $examenes)
    {
        foreach ($examenes as $examen) {
            $examen->setMedico($this);
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
     * @see Zend\\Stdlib\\Hydrator\\ArraySerializable::extract expects the provided object to implement getArrayCopy()
     * @return multitype
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}