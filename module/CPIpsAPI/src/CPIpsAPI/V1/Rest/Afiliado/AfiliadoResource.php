<?php
namespace CPIpsAPI\V1\Rest\Afiliado;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\EntityManager;

class AfiliadoResource extends AbstractResourceListener
{
    /**
     * Main entity class string
     * @var string
     */
    const ENTITY_CLASS = 'CPIpsAPI\V1\Rest\Afiliado\AfiliadoEntity';    //~
    
    /**
     * Doctrine Entity Manager
     * @var EntityManager
     */
    protected $em;
    
    /**
     * Use constructor to inject dependencies
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        // Create Doctrine Hydrator 
        $hydrator = new DoctrineHydrator($this->em);
        
        // Decode json data
        $dataArray = json_decode(json_encode($data), true);
        
        // Create new entity and hydrate data
        $entity = new AfiliadoEntity();
        $entity = $hydrator->hydrate($dataArray, $entity);
        
        // Execute
        $this->em->persist($entity);
        $this->em->flush();
        
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
        // Check if can't truly delete (only softdelete) - Role defined
        // @todo: define role check for this
        if (true) {
            // Enable Softdeleteable filter
            $this->em->getFilters()->enable('soft-deleteable');            
        }
        
        // Get the entity
        $entity = $this->em->getRepository(self::ENTITY_CLASS)->find($id);
        
        // Remove the entity
        $this->em->remove($entity);
        $this->em->flush();
        
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
        // Enable Softdeleteab$this->emfilter
        $this->em->getFilters()->enable('soft-deleteable');
        
        // Get the entity
        $entity = $this->em->getRepository(self::ENTITY_CLASS)->find($id);
        
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
        // Enable Softdeleteable filter
        $this->em->getFilters()->enable('soft-deleteable');
        
        // Get paged collection
        $collection = $this->em->getRepository(self::ENTITY_CLASS)->pageBy($params);
        
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
        // Create Doctrine Hydrator
        $hydrator = new DoctrineHydrator($this->em);
        
        // Enable Softdeleteable filter
        $this->em->getFilters()->enable('soft-deleteable');
        
        // Decode json data
        $dataArray = json_decode(json_encode($data), true);
        
        // Get entity by id and hydrate data
        $entity = $this->em->getRepository(self::ENTITY_CLASS)->find($id);
        $entity = $hydrator->hydrate($dataArray, $entity);
        
        // Execute
        $this->em->persist($entity);
        $this->em->flush();
        
        // Return new created entity
        return $entity;
    }
}
