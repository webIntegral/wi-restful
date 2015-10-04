<?php
namespace WiContact\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts_phones")
 */
class ContactPhone
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
     * @var \WiContact\Entity\Contact 
     *      @ORM\ManyToOne(targetEntity="WiContact\Entity\Contact", inversedBy="phones")
     */
    protected $contact;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $phone;

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
     * @return the $contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Allow null to remove association
     *
     * @param Contact $contact
     */
    public function setContact(Contact $contact = null)
    {
        $this->contact = $contact;
    }

    /**
     *
     * @return the $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     *
     * @param string $phone            
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}