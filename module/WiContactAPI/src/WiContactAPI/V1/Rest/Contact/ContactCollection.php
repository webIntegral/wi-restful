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
        
        // Table alias | Alias para las tablas
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
        $i = 0;
        
        // If filters are setted | Si los filtros están definidos
        if (property_exists($params, 'filters')) {
            
            // Decode filters string | decodificar el string con los filtros
            $filters = json_decode($params->filters);
            
            // Create each filter in Query | Crear cada filtro en la consulta
            foreach ($filters as $filter => $string) {
                
                // Check if field allows filtering | Checkear si el campo permite filtrar
                if (array_key_exists($filter, $fields)) {
                    
                    // Count | Contador
                    $i = $i + 1; 
                    
                    // Get the field | Cargar el campo a filtrar
                    $field = $fields[$filter];
                    
                    // Clean filter string | Limpiar el texto del filtro 
                    // @todo: Ver porqué el underscore no funciona en la búsqueda
                    $string = '%' . preg_replace("/[^a-zA-Z0-9áéíóúüÁÉÍÓÚÜ',.@&_-]+/", "", $string) . '%';
                    
                    // Add Where/like clause with filter | Agregar clausula Where/like con el filtro
                    $qb->andWhere(
                        $qb->expr()->like($field, "?$i")
                    );
                    $qb->setParameter($i, $string);
                    
                } // if
            } // foreach         
        } // if
        
        
        
    } // function pageBy
    
} // class
