<?php
namespace CPIpsAPI\V1\Rest\Examen;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZendPaginator;
use Doctrine\ORM\EntityRepository as EntityRepository;
use WiBase\Service\WiDoctrineCollectionService;

class ExamenCollection extends EntityRepository
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
    
        // Table name | Nombres de las tablas
        $tbl1 = 'wcp_examenes';
        $tbl2 = 'wcp_medicos';
        $tbl3 = 'wcp_afiliados';
        $tbl4 = 'wcp_examenes_tipos';
    
        // Fields that allow search
        $searchables = array(
            'id' => $tbl1 . '.id',
            'medico' => $tbl2. '.nombre',
            '_embedded.examenTipo.tipo' => $tbl4. '.tipo',
            '_embedded.medico.nombre' => $tbl2. '.nombre',
            'created.date' => $tbl1. '.created',
        );
        
        // Fields that allow sorting
        $sortables = array(
            'id' => $tbl1 . '.id',
            'medico' => $tbl2. '.nombre',
            '_embedded.examenTipo.tipo' => $tbl4. '.tipo',
            '_embedded.medico.nombre' => $tbl2. '.nombre',
            'created.date' => $tbl1. '.created',
        );
        
        // Fields that allow filters
        $filterables = array(
            'afiliadoId' => $tbl1. '.afiliado',
        );
    
        // Create query builder
        $qb = $this->createQueryBuilder("$tbl1")
        ->select("$tbl1, $tbl2, $tbl3")         // select all tables
        ->leftJoin($tbl1.'.medico', $tbl2)      // join with medicos
        ->leftJoin($tbl1.'.afiliado', $tbl3)    // join with afiliados
        ->leftJoin($tbl1.'.examenTipo', $tbl4); // join with afiliados
    
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