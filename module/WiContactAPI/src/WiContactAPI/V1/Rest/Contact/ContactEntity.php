<?php
namespace WiContactAPI\V1\Rest\Contact;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="WiContactAPI\V1\Rest\Contact\ContactCollection")
 * @ORM\Table(name="wi_contacts")
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