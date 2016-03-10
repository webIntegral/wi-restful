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
        // Table names
        $tbl1 = 'user';
        $tbl2 = 'accesstoken_oauth2';
        
        // Query builder instance creation
        $qb = $this->createQueryBuilder("$tbl1")
            ->select('user')
            #->join($tbl1.'.id', 't1', 'WITH', $tbl2.'.user_id = t1.id')
            ->join('accesstoken_oauth2', 't', 'WITH', 'user.id = ?1', 't.user_id')
            
            #->innerJoin('c.phones', 'p', 'WITH', 'p.phone = :phone')
            #->join($tbl1.'.id', $tbl2)
        ;
        
        // Return new ZendPaginator | Devolver un nuevo paginador
        return new ZendPaginator(new PaginatorAdapter(new ORMPaginator($qb)));
    }
}
