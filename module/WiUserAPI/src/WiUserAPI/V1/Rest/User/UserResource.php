<?php
namespace WiUserAPI\V1\Rest\User;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class UserResource extends AbstractResourceListener implements ServiceLocatorAwareInterface
{
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        // Get entity manager and Doctrine Hydrator 
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $hydrator = new DoctrineHydrator($em);
        
        // Decode json data
        $dataArray = json_decode(json_encode($data), true);
        
        // Create new entity and hydrate data
        $entity = new UserEntity();
        $entity = $hydrator->hydrate($dataArray, $entity);
        
        // Execute
        $em->persist($entity);
        $em->flush();
        
        // Return new created entity
        return $entity;
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        /*
         * @todo: Antes de borrar, verificar si el registro no está ya borrado.
         * Tener en cuenta que si el registro está virtualmente borrado, borrarlo nuevamente
         * lo borrará de la base de datos. Esto solo lo debería de hacer alguien con privilegios altos.
         */
        
        // Get entity manager
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        // Get the entity
        $entity = $em->getRepository('WiUserAPI\V1\Rest\User\UserEntity')->find($id);
        
        // Remove the entity
        $em->remove($entity);
        $em->flush();
        
        // Return true for success
        return true;
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        // Get entity manager
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        // Enable Softdeleteable filter
        $em->getFilters()->enable('soft-deleteable');
        
        // Get the entity
        $entity = $em->getRepository('WiUserAPI\V1\Rest\User\UserEntity')->find($id);
        // Do not return password
        $entity->unsetPassword();
        
        // Return it
        return $entity;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        // Get entity manager
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        // Enable Softdeleteable filter
        $em->getFilters()->enable('soft-deleteable');
        
        // Get paged collection
        $collection = $em->getRepository('WiUserAPI\V1\Rest\User\UserEntity')->pageBy($params);
        
        return $collection;
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
        // Get entity manager and Doctrine Hydrator 
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $hydrator = new DoctrineHydrator($em);
        
        // Enable Softdeleteable filter
        $em->getFilters()->enable('soft-deleteable');
        
        // Decode json data
        $dataArray = json_decode(json_encode($data), true);
        
        // Get entity by id and hydrate data
        $entity = $em->getRepository('WiUserAPI\V1\Rest\User\UserEntity')->find($id);
        $entity = $hydrator->hydrate($dataArray, $entity);
        
        // Execute
        $em->persist($entity);
        $em->flush();
        
        // Return new created entity
        return $entity;
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
