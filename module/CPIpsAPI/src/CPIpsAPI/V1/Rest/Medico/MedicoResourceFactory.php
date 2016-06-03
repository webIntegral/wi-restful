<?php
namespace CPIpsAPI\V1\Rest\Medico;

class MedicoResourceFactory
{
    public function __invoke($services)
    {
        // inject Doctrine Entity Manager
        $em = $services->get('doctrine.entitymanager.orm_default');
        
        return new MedicoResource($em);
    }
}
