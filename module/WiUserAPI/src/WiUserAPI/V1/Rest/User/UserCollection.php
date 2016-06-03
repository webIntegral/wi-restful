<?php
namespace WiUserAPI\V1\Rest\User;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZendPaginator;
use Doctrine\ORM\EntityRepository as EntityRepository;


class UserCollection extends EntityRepository
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
        $tbl1 = 'user';
    
        // Fields that allow search
        $searchables = array(
            'id' => $tbl1 . '.id',
            'username' => $tbl1. '.username',
            'displayName' => $tbl1. '.displayName'
        );
        
        // Fields that allow sorting
        $sortables = array(
            'id' => $tbl1 . '.id',
            'username' => $tbl1. '.username',
            'displayName' => $tbl1. '.displayName'
        );
        
        // Fields that allow filters
        $filterables = array(
            
        );
    
        // Create query builder
        $qb = $this->createQueryBuilder("$tbl1")
            ->select("partial $tbl1.{id, username, displayName, email, role, deleted, created, updated}");    // select all tables
    
        // Build Search
        
        // If search parameter is set
        if (property_exists($params, 'search')) {
            // If serach is not empty (empty resets search)
            if ('' != $params->search) {
        
                // Clean search string
                $searchStr = '%' . preg_replace("/[^a-zA-Z0-9áéíóúüÁÉÍÓÚÜ',.@&_-]+/", "", $params->search) . '%';
                // Init query builder search expression
                $searchExpr = $qb->expr()->orX();
                
                // For each field
                $i = 1;
                foreach ($searchables as $field => $column) {
                    // Add field and search
                    $searchExpr->add($qb->expr()->like($column, "?$i"));
                    $qb->setParameter($i, $searchStr);
                    
                    // Count
                    $i = $i + 1;
                } // foreach
                
                // Add Where clause
                $qb->andWhere($searchExpr);
        
            } // if
        } // if
        
        // Build filters
        
        // If filters is set
        if (property_exists($params, 'filters')) {
        
            // Decode json_string
            $filters = json_decode($params->filters);
            // Init query builder filter expression
            $filterExpr = $qb->expr()->andX();
        
            // for each filter
            $i = 1;
            foreach ($filters as $filter => $value) {
                // If field can be filtered
                if (array_key_exists($filter, $filterables)) {
                    // Add filter and value
                    $filterExpr->add($qb->expr()->eq($filterables[$filter], "?$i"));
                    $qb->setParameter($i, $value);
        
                    // Count
                    $i = $i + 1;
                }
            }
            
            // Add Where clause
            $qb->andWhere($filterExpr);
        }
        
        // Build Sorts
        
        // If sorts are set
        if (property_exists($params, 'sorts')) {
            
            // Decode json_string
            $sorts = json_decode($params->sorts);
            
            // for each sort
            $i = 1;
            foreach ($sorts as $sort => $dir) {
                // If field is sortable
                if (array_key_exists($sort, $sortables)) {
                    // If sort direction is valid
                    if (strtoupper($dir) === 'ASC' || strtoupper($dir) === 'DESC') {
                        
                        // other rounds addOrderBy
                        if ($i > 1) {
                            $qb->addOrderBy($sortables[$sort], $dir);
                            // first round addOrder
                        } else {
                            $qb->orderBy($sortables[$sort], $dir);
                        }
                        
                        // Count
                        $i = $i + 1;
                    } // if
                } // if
            } // foreach
            
        } // if
        
        // Return new ZendPaginator | Devolver un nuevo paginador
        return new ZendPaginator(new PaginatorAdapter(new ORMPaginator($qb)));
        
    } // function pageBy
}