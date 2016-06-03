<?php
namespace CPIpsAPI\V1\Rest\ExamenTipo;

class ExamenTipoResourceFactory
{
    public function __invoke($services)
    {
        // inject Doctrine Entity Manager
        $em = $services->get('doctrine.entitymanager.orm_default');
        
        return new ExamenTipoResource($em);
    }
}
