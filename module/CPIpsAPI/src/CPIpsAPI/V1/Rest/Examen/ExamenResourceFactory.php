<?php
namespace CPIpsAPI\V1\Rest\Examen;

class ExamenResourceFactory
{
    public function __invoke($services)
    {
        // inject Doctrine Entity Manager
        $em = $services->get('doctrine.entitymanager.orm_default');
        
        return new ExamenResource($em);
    }
}
