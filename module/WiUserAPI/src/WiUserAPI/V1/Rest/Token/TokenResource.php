<?php
namespace WiUserAPI\V1\Rest\Token;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class TokenResource extends AbstractResourceListener implements ServiceLocatorAwareInterface
{
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Deletes token in the Identity variable (logout user / kills session)
     * If parameter "all" is specified, deletes all avaliable tokens
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data = array())
    {
        
        /*
         * @todo: Habilitar que se puedan borrar todos los tokens (matar todas las sesiones),
         * cuando se indique la palabra clave "all" y el usuario sea un superusuario
         */
        
        // Retrieve identity
        $identity = $this->getIdentity();
        
        // If user is Guest, throw 401 Anuthorized
        if (is_a($identity, 'ZF\MvcAuth\Identity\GuestIdentity')) {
            return new ApiProblem(401, "Token Delete method can't be used by a Guest user");
        }
        
        // Get accessToken
        $authIdentity = $identity->getAuthenticationIdentity();
        $accessToken = $authIdentity['access_token'];
        
        // Retrieve accessToken entity and delete it
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $tokenSearch = $em->getRepository('ZF\OAuth2\Doctrine\Entity\AccessToken')->findBy(array(
            'accessToken' => $accessToken
        ));
        // since findBy returns an array, retrieve first item
        $tokenEntity = $tokenSearch[0];
        
        // Remove the entity
        $em->remove($tokenEntity);
        $em->flush();
        
        // Return true for success
        return true;
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
    
    /**
     * Set Service Locator
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }
    
    /**
     * Get Service Locator
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }
}
