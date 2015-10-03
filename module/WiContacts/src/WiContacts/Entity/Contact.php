<?php
namespace WiContacts\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contact
{

    /**
     *
     * @var int 
     *      @ORM\Id
     *      @ORM\Column(type="integer")
     *      @ORM\GeneratedValue
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
     * @param int $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param string $name            
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}