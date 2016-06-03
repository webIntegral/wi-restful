<?php
namespace CPIpsAPI\V1\Rest\Medico;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZendPaginator;
use Doctrine\ORM\EntityRepository as EntityRepository;
use WiBase\Service\WiDoctrineCollectionService;

class MedicoCollection extends EntityRepository
{
    
    /**
     * Custom method to get paged, filtered, ordered data |
     * Método para obtener datos paginados, filtrados y ordenados
     * 
     * @param array $params
     * @return  \Zend\Paginator\Paginator
     */
    public function pageBy($params = array())
    {
        // Table name
        $tbl1 = 'wcp_medicos';
        
        // Fields that allow search
        $searchables = array(
            'id' => $tbl1 . '.id',
            'nombre' => $tbl1 . '.nombre',
            'especialidad' => $tbl1 . '.especialidad',
        );
        
        // Fields that allow sorting
        $sortables = array(
            'id' => $tbl1 . '.id',
            'nombre' => $tbl1 . '.nombre',
            'especialidad' => $tbl1 . '.especialidad',
        );
        
        // Fields that allow filters
        $filterables = array(
            'activo' => $tbl1. '.activo',
        );
        
        // Create query builder
        $qb = $this->createQueryBuilder("$tbl1")
            ->select("$tbl1");
        
        $wiDCService = new WiDoctrineCollectionService();
        
        // Build Search
        
        // If search parameter is set
        if (property_exists($params, 'search')) {
            // If serach is not empty (empty resets search)
            if ('' != $params->search) {
                
                // Ask WiDoctrineCollectionService to build search query
                $wiDCService->buildSearch($qb, $searchables, $params->search);
            }
        }
        
        
        // Build filters
        
        // If filters is set
        if (property_exists($params, 'filters')) {
        
            // Decode json_string
            $filters = json_decode($params->filters);
            
            // Ask WiDoctrineCollectionService to build filter query
            $wiDCService->buildFilters($qb, $filterables, $filters);
        }
        
        
        // Build Sorts
        
        // If sorts are set
        if (property_exists($params, 'sorts')) {
            
            // Decode json_string
            $sorts = json_decode($params->sorts);
            
            // Ask WiDoctrineCollectionService to build filter query
            $wiDCService->buildSorts($qb, $sortables, $sorts);
        }
        
        // Return new ZendPaginator | Devolver un nuevo paginador
        return new ZendPaginator(new PaginatorAdapter(new ORMPaginator($qb)));
        
    } // function pageBy
}