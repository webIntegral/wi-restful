<?php
namespace WiContact\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contact
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
     * @var ArrayCollection; @ORM\OneToMany(targetEntity="WiContact\Entity\ContactPhone", mappedBy="contact", cascade={"persist"})
     */
    protected $phones;

    /**
     * Never forget to initialize collections
     */
    public function __construct()
    {
        $this->phones = new ArrayCollection();
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
     * @param Collection $phones
     */
    public function addPhones(Collection $phones)
    {
        foreach ($phones as $phone) {
            $phone->setContact($this);
            $this->phones->add($phone);
        }
    }
    
    /**
     * @param Collection $phones
     */
    public function removePhones(Collection $phones)
    {
        foreach ($phones as $phone) {
            $phone->setContact($this);
            $this->phones->removeElement($phone);
        }
    }

    /**
     *
     * @return the $phones
     */
    public function getPhones()
    {
        return $this->phones;
    }
}