<?php
namespace CPIpsAPI\V1\Rest\Examen;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\EntityManager;
use Zend\Http\Client;

class ExamenResource extends AbstractResourceListener
{
    /**
     * Main entity class string
     * @var string
     */
    const ENTITY_CLASS = 'CPIpsAPI\V1\Rest\Examen\ExamenEntity';    //~
    
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
        $entity = new ExamenEntity();
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
        
        /*
         * @todo: This afiliadoId should be part of service route paramertes
         * @todo: If afiliadoId doesn't match, it should return an error
         */
        
        // Get filters from query (afiliadoId)
        $e = $this->getEvent();
        $query = $e->getRequest()->getQuery();
        
        // If filter is set, check if entity properties coincide with filters
        if (isset($query->filters)) {
            // Decode filters
            $filters = json_decode($query->filters);
            
            // If filter parameter afiliadoId is set
            if (isset($filters->afiliadoId)) {
                
                // Check if entity afiliadoId is not the same, empty entity
                if ($entity->getAfiliado()->getId() != intval($filters->afiliadoId)) {
                    
                    // Return empty entity
                    $entity = null;
                }
            }
            
            //~ put here the rest of filters
        }
        
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
        
        // Update entity in local database
        $this->em->persist($entity);
        $this->em->flush();
        
        // get afiliado content
        $afiliado = $entity->getAfiliado();
        
        // if tipoPaciente is not 'Particular' (1) and definitivo set
        if ('1' != $afiliado->getTipoPaciente() && true === $entity->getDefinitivo()) {
            
            // get parameters by
            $parameters = $this->em->getRepository('CPIpsAPI\V1\Rest\ExamenParametro\ExamenParametroEntity')
                ->findBy(array(
                    'idAliasCups' => $entity->getExamenTipo(),      // examenTipo
                    'sexo' => array($afiliado->getSexo(), 'A')      // Sexo (M, F y A)
            ));

            // Get xml for request
            $xml = $entity->getBuiltXml($parameters);
            
            // Save xmlRequest
            $entity->setXmlRequest($xml);
            
            /*
             * @todo: If the app needs more of this requests, move code to service like 'CompensarRemoteResource'.
             * This server exposes all posible methods, takes the XML and handles connection, requests, responses, 
             * errors, etc.
             */
            
            // Build http client and set method
            $client = new Client('http://190.144.216.57/WSCOMRIC/RIC/RIC.asmx/RegistroLaboratorio', array(
                'maxredirects' => 0,
                'timeout' => 30,
            ));
            $client->setMethod('POST');
            
            // Set post parameters
            $client->setParameterPost(array(
                'sApl' => 'MEVISALUD',
                'sXml' => $xml,
            ));
            
            // Excecute request
            // @todo: Catch possible errors (server not avaliable, no internet connection, etc)
            $xmlRequest = $client->send();
            
            // Get xml response
            $xmlResponse = $xmlRequest->getBody();
            
            /*
             * @todo: Here, we should check $xmlResponse and:
             *  1. If error, unset "definitivo", since it was not saved
             *  2. If user can do something to solve error, indicate what happened and what to do
             *  3. If is just a server error, inform about error
             */
            
            // Save xmlResponse
            $entity->setXmlResponse($xmlResponse);
            
            // Update entity
            $this->em->persist($entity);
            $this->em->flush();
            
        } // if definitivo
        
        // Return new created entity
        return $entity;
    }
}
