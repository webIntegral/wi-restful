<?php
namespace WiUserAPI\V1\Rest\User;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZendPaginator;
use Doctrine\ORM\EntityRepository as EntityRepository;


class UserCollection extends EntityRepository
{
    
    /*
     * @todo: Code function pageBy.
     */
}
