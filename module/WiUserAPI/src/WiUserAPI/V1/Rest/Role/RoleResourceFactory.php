<?php
namespace WiUserAPI\V1\Rest\Role;

class RoleResourceFactory
{
    public function __invoke($services)
    {
        // inject Doctrine Entity Manager
        $em = $services->get('doctrine.entitymanager.orm_default');
        
        return new RoleResource($em);
    }
}
