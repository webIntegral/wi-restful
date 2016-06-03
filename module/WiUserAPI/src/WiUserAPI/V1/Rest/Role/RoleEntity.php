<?php
namespace WiUserAPI\V1\Rest\Role;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="WiUserAPI\V1\Rest\Role\RoleCollection")
 * @ORM\Table(name="wi_roles")
 * @Gedmo\SoftDeleteable(fieldName="deleted", timeAware=false)
 */
class RoleEntity
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
     * @var int @ORM\Column(type="string", nullable=false)
     */
    protected $role;
    
    /**
     *
     * @var int @ORM\Column(type="string", nullable=false)
     */
    protected $displayName;
    
    /**
     *
     * @var int @ORM\Column(type="string", nullable=false)
     */
    protected $description;

    /**
     *
     * @var array @ORM\Column(type="array", nullable=true)
     */
    protected $roleAcl = array();

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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="WiUserAPI\V1\Rest\User\UserEntity", mappedBy="role")
     */
    protected $users;
    
    /**
     * Initialize collections
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

 /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

 /**
     * @return the $role
     */
    public function getRole()
    {
        return $this->role;
    }

 /**
     * @param int $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

 /**
     * @return the $displayName
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

 /**
     * @param int $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

 /**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

 /**
     * @param int $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

 /**
     * @return the $roleAcl
     */
    public function getRoleAcl()
    {
        return $this->roleAcl;
    }

 /**
     * @param array $roleAcl
     */
    public function setRoleAcl($roleAcl)
    {
        $this->roleAcl = $roleAcl;
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
    
    /**
     *
     * @param Collection $users
     */
    public function addUsers(Collection $users)
    {
        foreach ($users as $user) {
            $user->setRole($this);
            $this->users->add($user);
        }
    }
    
    /**
     *
     * @param Collection $users
     */
    public function removeUsers(Collection $users)
    {
        foreach ($users as $user) {
            $user->setRole($this);
            $this->users->removeElement($user);
        }
    }

 /**
     * @return the $users
     */
    public function getUsers()
    {
        return $this->users;
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
     *
     * @see Zend\\Stdlib\\Hydrator\\ArraySerializable::extract expects the provided object to implement getArrayCopy()
     * @return multitype
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
