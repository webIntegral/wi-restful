<?php
namespace WiUserAPI\V1\Rest\User;

use ZF\OAuth2\Doctrine\Entity\UserInterface;
use Zend\Stdlib\ArraySerializableInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\Crypt\Password\Bcrypt;

/**
 * @ORM\Entity(repositoryClass="WiUserAPI\V1\Rest\User\UserCollection")
 * @ORM\Table(name="user")
 * @Gedmo\SoftDeleteable(fieldName="deleted", timeAware=false)
 */
class UserEntity implements UserInterface, ArraySerializableInterface
{

    /**
     *
     * @var int @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     *      @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $displayName;

    /**
     * @ORM\Column(type="string")
     */
    protected $state;

    /**
     * @var WiUserAPI\V1\Rest\Role\RoleEntity @ORM\ManyToOne(targetEntity="WiUserAPI\V1\Rest\Role\RoleEntity", inversedBy="users", fetch="EAGER")
     */
    protected $role;

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

    protected $client;

    protected $accessToken;

    protected $authorizationCode;

    protected $refreshToken;

    protected $profile;

    protected $country;

    protected $phoneNumber;

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'username':
                    $this->setUsername($value);
                    break;
                case 'displayName':
                    $this->setDisplayName($value);
                    break;
                case 'password':
                    $this->setPassword($value);
                    break;
                case 'profile':
                    $this->setProfile($value);
                    break;
                case 'email':
                    $this->setEmail($value);
                    break;
                case 'country':
                    $this->setAddress($value);
                    break;
                case 'phone_number':
                case 'phoneNumber':
                    $this->setPhone($value);
                    break;
                case 'role':
                    $this->setRole($value);
                    break;
                case 'deleted':
                    $this->setDeleted($value);
                    break;
                default:
                    break;
            }
        }
        return $this;
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'displayName' => $this->getDisplayName(),
            'password' => $this->getPassword(),
            'profile' => $this->getProfile(),
            'email' => $this->getEmail(),
            'country' => $this->getCountry(),
            'phone_number' => $this->getPhoneNumber(), // underscore formatting for openid
            'phoneNumber' => $this->getPhoneNumber(),
            'role' => $this->getRole(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated(),
            'deleted' => $this->getDeleted()
        );
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
     * @param field_type $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return the $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     * @param field_type $username            
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     *
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     *
     * @param field_type $password            
     */
    public function setPassword($password)
    {
        $bcrypt = new Bcrypt();
        $this->password = $bcrypt->create($password);
    }
    
    /**
     * This method allows to clear password to avoid return it on api services
     */
    public function unsetPassword() 
    {
        $this->password = '';
    }

    /**
     *
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param field_type $email            
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     *
     * @return the $displayName
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     *
     * @param field_type $displayName            
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     *
     * @return the $state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     *
     * @param field_type $state            
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     *
     * @return the $role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     *
     * @param field_type $role            
     */
    public function setRole($role)
    {
        $this->role = $role;
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
     * @return the $client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     *
     * @param field_type $client            
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     *
     * @return the $accessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     *
     * @param field_type $accessToken            
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     *
     * @return the $authorizationCode
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     *
     * @param field_type $authorizationCode            
     */
    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
    }

    /**
     *
     * @return the $refreshToken
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     *
     * @param field_type $refreshToken            
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     *
     * @return the $profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     *
     * @param field_type $profile            
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     *
     * @return the $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @param field_type $country            
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     *
     * @return the $phoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     *
     * @param field_type $phoneNumber            
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}