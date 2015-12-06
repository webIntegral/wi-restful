<?php
namespace WiContactAPI\V1\Rest\Contact;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ContactResource extends AbstractResourceListener implements ServiceLocatorAwareInterface
{
    
    // @todo: Disable/Enable soft-deleteable filter conditionally, soy big Admins can view
    // deleted entities and reenable them. Enable should be global, disable locally!
    
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
        $entity = new ContactEntity();
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
        // Get entity manager
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        // Get the entity
        $entity = $em->getRepository('WiContactAPI\V1\Rest\Contact\ContactEntity')->find($id);
        
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
        $entity = $em->getRepository('WiContactAPI\V1\Rest\Contact\ContactEntity')->find($id);
        
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
        $collection = $em->getRepository('WiContactAPI\V1\Rest\Contact\ContactEntity')->pageBy($params);
        
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
        $entity = $em->getRepository('WiContactAPI\V1\Rest\Contact\ContactEntity')->find($id);
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
