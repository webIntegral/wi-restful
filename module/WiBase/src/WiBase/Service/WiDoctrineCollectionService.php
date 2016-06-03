<?php 
namespace WiBase\Service;

use Doctrine\ORM\QueryBuilder;

/**
 * This service implements methos to build queries (or at list part of queries)
 * for Doctrine Collections to handle searching, sorting and filtering.
 * 
 * @author Mario <mario@webintegral.com.co
 */
class WiDoctrineCollectionService
{
    
    function __construct()
    {
        
    }
    
    /**
     * Build a search query ($field LIKE $searchString) for each field in $fields array
     * using $searchString as search string
     * 
     * @param QueryBuilder $qb
     * @param array $fields
     * @param string $searchString
     */
    public static function buildSearch(QueryBuilder $qb, array $fields, $searchString)
    {
        // Clean search string
        $searchStr = '%' . preg_replace("/[^a-zA-Z0-9áéíóúüÁÉÍÓÚÜ ',.@&_-]+/", "", $searchString) . '%';
        
        // Init query builder search expression
        $searchExpr = $qb->expr()->orX();
        
        // For each field
        $i = 1;
        foreach ($fields as $field => $column) {
            
            // Add field and search
            $searchExpr->add($qb->expr()->like($column, "?$i"));
            $qb->setParameter($i, $searchStr);
        
            // Count
            $i = $i + 1;
            
        } // foreach
        
        // Add Where clause
        $qb->andWhere($searchExpr);
    }
    
    /**
     * Builds a filter query ($field = value) for each field in $fields array
     * using values defined in $filters array
     * 
     * @todo: Check why interface sends an object instead of an array. This is why I can't
     * set type constraint to array ($filters)
     * 
     * @param QueryBuilder $qb
     * @param array $fields
     * @param array $filters
     */
    public static function buildFilters(QueryBuilder $qb, array $fields, $filters)
    {
        // Init query builder filter expression
        $filterExpr = $qb->expr()->andX();
        
        // for each filter
        $i = 1;
        foreach ($filters as $filter => $value) {
            // If field can be filtered
            if (array_key_exists($filter, $fields)) {
                // Add filter and value
                $filterExpr->add($qb->expr()->eq($fields[$filter], "?$i"));
                $qb->setParameter($i, $value);
        
                // Count
                $i = $i + 1;
            }
        }
        
        // Add Where clause
       $qb->andWhere($filterExpr);
    }
    
    /**
     * Builds a sort query (ORDER BY $field $sort) for each field in $fields array
     * using sorts defined in $sorts array
     * 
     * @todo: Check why interface sends an object instead of an array. This is why I can't
     * set type constraint to array ($sorts)
     * 
     * @param QueryBuilder $qb
     * @param array $fields
     * @param array $sorts
     */
    public static function buildSorts(QueryBuilder $qb, array $fields, $sorts)
    {
        // for each sort
        $i = 1;
        foreach ($sorts as $sort => $dir) {
            // If field is sortable
            if (array_key_exists($sort, $fields)) {
                // If sort direction is valid
                if (strtoupper($dir) === 'ASC' || strtoupper($dir) === 'DESC') {
        
                    // other rounds addOrderBy
                    if ($i > 1) {
                        $qb->addOrderBy($fields[$sort], $dir);
                        // first round addOrder
                    } else {
                        $qb->orderBy($fields[$sort], $dir);
                    }
        
                    // Count
                    $i = $i + 1;
                } // if
            } // if
        } // foreach
    }
}
