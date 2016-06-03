<?php
namespace CPIpsAPI\V1\Rest\ExamenTipo;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="CPIpsAPI\V1\Rest\ExamenTipo\ExamenTipoCollection")
 * @ORM\Table(name="wcp_examenes_tipos")
 * @Gedmo\SoftDeleteable(fieldName="deleted", timeAware=false)
 */
class ExamenTipoEntity
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
    protected $tipo;

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
     * @ORM\OneToMany(targetEntity="CPIpsAPI\V1\Rest\Examen\ExamenEntity", mappedBy="examenTipo")
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
     * @return the $tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     *
     * @param string $tipo            
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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
            $examen->setExamenTipo($this);
            $this->examenes->add($examen);
        }
    }
    
    /**
     * @param Collection $examenes
     */
    public function removeExamenes(Collection $examenes)
    {
        foreach ($examenes as $examen) {
            $examen->setExamenTipo($this);
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
