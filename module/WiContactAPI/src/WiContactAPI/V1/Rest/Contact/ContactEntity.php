<?php
namespace WiContactAPI\V1\Rest\Contact;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="WiContactAPI\V1\Rest\Contact\ContactCollection")
 * @ORM\Table(name="wi_contacts")
 * @Gedmo\SoftDeleteable(fieldName="deleted", timeAware=false)
 */
class ContactEntity
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
    protected $name;
    
    /**
     * Creation datetime
     * 
     * @var \DateTime $created
     *      @Gedmo\Timestampable(on="create")
     *      @ORM\Column(type="datetime")
     */
    protected $created;
    
    /**
     * Last update datetime
     * @var \DateTime $updated
     *      @Gedmo\Timestampable(on="update")
     *      @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated;
    
    /**
     * Deletion datetime
     * @var \DateTime $deleted
     *      @ORM\Column(type="datetime", nullable=true)
     */
    protected $deleted;

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
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @param string $name            
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * @return the $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return the $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return the $deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param DateTime $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

 // @todo: Add phones support
    // @todo: Add Gedmo Annotations support
    
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