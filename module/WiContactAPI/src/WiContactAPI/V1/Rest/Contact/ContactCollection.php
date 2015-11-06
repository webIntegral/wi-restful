<?php
namespace WiContactAPI\V1\Rest\Contact;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZendPaginator;
use Doctrine\ORM\EntityRepository as EntityRepository;

class ContactCollection extends EntityRepository
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
        $tbl1 = 'wi_contact';
        
        // Define fields that allow filtering and ordering | 
        // Definir los campos que permiten filtros y ordenación
        $fields = array(
            'id' => $tbl1 . '.id',
            'name' => $tbl1 . '.name'
        );
        
        // Create query builder | Crear el query builder
        $qb = $this->createQueryBuilder("$tbl1")
            ->select("$tbl1");
        
        // Add filters | Agregar filtros
        
        // If filters are setted | Si los filtros están definidos
        if (property_exists($params, 'search')) {
            
            // If filter is not empty | Si el filtro no está vacío
            if ('' != $params->search) {
                
                // Clean filter string | Limpiar el string del filtro
                $filter = '%' . preg_replace("/[^a-zA-Z0-9áéíóúüÁÉÍÓÚÜ',.@&_-]+/", "", $params->search) . '%';
                
                // Init count to deal with Doctirne setParameter() function |
                // Inicializar el contador para utilizar la función setParameter() de Doctrine
                $i = 1;
                
                // For each field
                foreach ($fields as $field => $column) {
                    
                    // Add filters | Agregar los filtros
                    // Other rounds add orWhere | Las otras vueltas agregar orWhere
                    if ($i > 1) {
                        $qb->orWhere(
                            $qb->expr()->like($column, "?$i")
                        );
                        $qb->setParameter($i, $filter);
                        
                    // First round add where | Primera vuelta agregar where
                    } else {
                        $qb->where(
                            $qb->expr()->like($column, "?$i")
                        );
                        $qb->setParameter($i, $filter);
                    }
                    
                    // Count | Contador
                    $i = $i + 1;
                    
                } // foreach
                
            } // if

        } // if
        
        // Add Sorts | Agregar ordenación
        
        // If sorts are setted | Si hay ordenación
        if (property_exists($params, 'sorts')) {
            
            // Get sorts parameter | Obtener el parámetro sorts
            $sorts =json_decode($params->sorts);
            
            // for each sorted field | para cada campo ordenado
            $i = 0;
            foreach ($sorts as $sort => $dir) {
                
                // If field is sortable | Si el campo permite ordenación
                if (array_key_exists($sort, $fields)) {
                    
                    // If sort direction is valid
                    if (strtoupper($dir) === 'ASC' || strtoupper($dir) === 'DESC') {
                        
                        // Count | Contador
                        $i = $i + 1;
                        
                        // Get field | Obtener el campo
                        $field = $fields[$sort];
                        
                        // Add order clause | Agregar clausula de ordenación
                        $qb->addOrderBy($field, $dir);
                        
                    } // if
                    
                } // if
                
            } // foreach
            
        } // if
        
        
        // Return new ZendPaginator | Devolver un nuevo paginador
        return new ZendPaginator(new PaginatorAdapter(new ORMPaginator($qb)));
        
    } // function pageBy
    
} // class
