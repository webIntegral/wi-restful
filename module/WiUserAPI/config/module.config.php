<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'WiUserAPI\\V1\\Rest\\User\\UserResource' => 'WiUserAPI\\V1\\Rest\\User\\UserResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'wi-user-api.rest.user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/:user_id]',
                    'defaults' => array(
                        'controller' => 'WiUserAPI\\V1\\Rest\\User\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'wi-user-api.rest.user',
        ),
    ),
    'zf-rest' => array(
        'WiUserAPI\\V1\\Rest\\User\\Controller' => array(
            'listener' => 'WiUserAPI\\V1\\Rest\\User\\UserResource',
            'route_name' => 'wi-user-api.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WiUserAPI\\V1\\Rest\\User\\UserEntity',
            'collection_class' => 'WiUserAPI\\V1\\Rest\\User\\UserCollection',
            'service_name' => 'User',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'WiUserAPI\\V1\\Rest\\User\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'WiUserAPI\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'WiUserAPI\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'WiUserAPI\\V1\\Rest\\User\\UserEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WiUserAPI\\V1\\Rest\\User\\UserCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ),
        ),
    ),
    'doctrine' => array(
        'configuration' => array(
            'orm_default' => array(
                'filters' => array(
                    'soft-deleteable' => 'Gedmo\\SoftDeleteable\\Filter\\SoftDeleteableFilter',
                ),
            ),
        ),
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    0 => 'Gedmo\\Timestampable\\TimestampableListener',
                    1 => 'Gedmo\\SoftDeleteable\\SoftDeleteableListener',
                ),
            ),
        ),
        'driver' => array(
            'WiUserAPI_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    0 => 'C:\\vhosts\\restful-wi\\module\\WiUserAPI\\config/../src/WiUserAPI/V1/Rest/User',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'WiUserAPI' => 'WiUserAPI_driver',
                ),
            ),
        ),
    ),
);
