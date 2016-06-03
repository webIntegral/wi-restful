<?php
namespace CPIpsAPI\V1\Rest\Afiliado;

class AfiliadoResourceFactory
{
    public function __invoke($services)
    {
        // inject Doctrine Entity Manager
        $em = $services->get('doctrine.entitymanager.orm_default');
        
        return new AfiliadoResource($em);
    }
}
