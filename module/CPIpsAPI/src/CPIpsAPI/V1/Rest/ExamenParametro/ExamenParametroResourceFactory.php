<?php
namespace CPIpsAPI\V1\Rest\ExamenParametro;

class ExamenParametroResourceFactory
{
    public function __invoke($services)
    {
        // inject Doctrine Entity Manager
        $em = $services->get('doctrine.entitymanager.orm_default');
        
        return new ExamenParametroResource($em);
    }
}
