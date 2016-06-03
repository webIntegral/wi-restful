<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'WiUserAPI\\V1\\Rest\\User\\UserResource' => 'WiUserAPI\\V1\\Rest\\User\\UserResourceFactory',
            'WiUserAPI\\V1\\Rest\\UserByToken\\UserByTokenResource' => 'WiUserAPI\\V1\\Rest\\UserByToken\\UserByTokenResourceFactory',
            'WiUserAPI\\V1\\Rest\\Token\\TokenResource' => 'WiUserAPI\\V1\\Rest\\Token\\TokenResourceFactory',
            'WiUserAPI\\V1\\Rest\\UserStatus\\UserStatusResource' => 'WiUserAPI\\V1\\Rest\\UserStatus\\UserStatusResourceFactory',
            'WiUserAPI\\V1\\Rest\\Role\\RoleResource' => 'WiUserAPI\\V1\\Rest\\Role\\RoleResourceFactory',
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
            'wi-user-api.rest.user-by-token' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user-by-token',
                    'defaults' => array(
                        'controller' => 'WiUserAPI\\V1\\Rest\\UserByToken\\Controller',
                    ),
                ),
            ),
            'wi-user-api.rest.token' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/token[/:token_id]',
                    'defaults' => array(
                        'controller' => 'WiUserAPI\\V1\\Rest\\Token\\Controller',
                    ),
                ),
            ),
            'wi-user-api.rest.user-status' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user-status[/:user_status_id]',
                    'defaults' => array(
                        'controller' => 'WiUserAPI\\V1\\Rest\\UserStatus\\Controller',
                    ),
                ),
            ),
            'wi-user-api.rest.role' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/role[/:role_id]',
                    'defaults' => array(
                        'controller' => 'WiUserAPI\\V1\\Rest\\Role\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'wi-user-api.rest.user',
            1 => 'wi-user-api.rest.user-by-token',
            2 => 'wi-user-api.rest.token',
            3 => 'wi-user-api.rest.user-status',
            4 => 'wi-user-api.rest.role',
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
                1 => 'PUT',
                2 => 'DELETE',
                3 => 'PATCH',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(
                0 => 'username',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WiUserAPI\\V1\\Rest\\User\\UserEntity',
            'collection_class' => 'WiUserAPI\\V1\\Rest\\User\\UserCollection',
            'service_name' => 'User',
        ),
        'WiUserAPI\\V1\\Rest\\UserByToken\\Controller' => array(
            'listener' => 'WiUserAPI\\V1\\Rest\\UserByToken\\UserByTokenResource',
            'route_name' => 'wi-user-api.rest.user-by-token',
            'route_identifier_name' => 'user_by_token_id',
            'collection_name' => 'user_by_token',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WiUserAPI\\V1\\Rest\\UserByToken\\UserByTokenEntity',
            'collection_class' => 'WiUserAPI\\V1\\Rest\\UserByToken\\UserByTokenCollection',
            'service_name' => 'UserByToken',
        ),
        'WiUserAPI\\V1\\Rest\\Token\\Controller' => array(
            'listener' => 'WiUserAPI\\V1\\Rest\\Token\\TokenResource',
            'route_name' => 'wi-user-api.rest.token',
            'route_identifier_name' => 'token_id',
            'collection_name' => 'token',
            'entity_http_methods' => array(
                0 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'DELETE',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WiUserAPI\\V1\\Rest\\Token\\TokenEntity',
            'collection_class' => 'WiUserAPI\\V1\\Rest\\Token\\TokenCollection',
            'service_name' => 'Token',
        ),
        'WiUserAPI\\V1\\Rest\\UserStatus\\Controller' => array(
            'listener' => 'WiUserAPI\\V1\\Rest\\UserStatus\\UserStatusResource',
            'route_name' => 'wi-user-api.rest.user-status',
            'route_identifier_name' => 'user_status_id',
            'collection_name' => 'user_status',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WiUserAPI\\V1\\Rest\\UserStatus\\UserStatusEntity',
            'collection_class' => 'WiUserAPI\\V1\\Rest\\UserStatus\\UserStatusCollection',
            'service_name' => 'UserStatus',
        ),
        'WiUserAPI\\V1\\Rest\\Role\\Controller' => array(
            'listener' => 'WiUserAPI\\V1\\Rest\\Role\\RoleResource',
            'route_name' => 'wi-user-api.rest.role',
            'route_identifier_name' => 'role_id',
            'collection_name' => 'role',
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
            'collection_query_whitelist' => array(
                0 => 'sorts',
                1 => 'search',
                2 => 'filters',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WiUserAPI\\V1\\Rest\\Role\\RoleEntity',
            'collection_class' => 'WiUserAPI\\V1\\Rest\\Role\\RoleCollection',
            'service_name' => 'Role',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'WiUserAPI\\V1\\Rest\\User\\Controller' => 'HalJson',
            'WiUserAPI\\V1\\Rest\\UserByToken\\Controller' => 'HalJson',
            'WiUserAPI\\V1\\Rest\\Token\\Controller' => 'HalJson',
            'WiUserAPI\\V1\\Rest\\UserStatus\\Controller' => 'HalJson',
            'WiUserAPI\\V1\\Rest\\Role\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'WiUserAPI\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WiUserAPI\\V1\\Rest\\UserByToken\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WiUserAPI\\V1\\Rest\\Token\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WiUserAPI\\V1\\Rest\\UserStatus\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WiUserAPI\\V1\\Rest\\Role\\Controller' => array(
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
            'WiUserAPI\\V1\\Rest\\UserByToken\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/json',
            ),
            'WiUserAPI\\V1\\Rest\\Token\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/json',
            ),
            'WiUserAPI\\V1\\Rest\\UserStatus\\Controller' => array(
                0 => 'application/vnd.wi-user-api.v1+json',
                1 => 'application/json',
            ),
            'WiUserAPI\\V1\\Rest\\Role\\Controller' => array(
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
            'WiUserAPI\\V1\\Rest\\UserByToken\\UserByTokenEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.user-by-token',
                'route_identifier_name' => 'user_by_token_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WiUserAPI\\V1\\Rest\\UserByToken\\UserByTokenCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.user-by-token',
                'route_identifier_name' => 'user_by_token_id',
                'is_collection' => true,
            ),
            'WiUserAPI\\V1\\Rest\\Token\\TokenEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.token',
                'route_identifier_name' => 'token_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WiUserAPI\\V1\\Rest\\Token\\TokenCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.token',
                'route_identifier_name' => 'token_id',
                'is_collection' => true,
            ),
            'WiUserAPI\\V1\\Rest\\UserStatus\\UserStatusEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.user-status',
                'route_identifier_name' => 'user_status_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WiUserAPI\\V1\\Rest\\UserStatus\\UserStatusCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.user-status',
                'route_identifier_name' => 'user_status_id',
                'is_collection' => true,
            ),
            'WiUserAPI\\V1\\Rest\\Role\\RoleEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.role',
                'route_identifier_name' => 'role_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WiUserAPI\\V1\\Rest\\Role\\RoleCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-user-api.rest.role',
                'route_identifier_name' => 'role_id',
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
                    1 => 'C:\\vhosts\\restful-wi\\module\\WiUserAPI\\config/../src/WiUserAPI/V1/Rest/Role',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'WiUserAPI' => 'WiUserAPI_driver',
                ),
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'WiUserAPI\\V1\\Rest\\UserStatus\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ),
            ),
            'WiUserAPI\\V1\\Rest\\User\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
            'WiUserAPI\\V1\\Rest\\UserByToken\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
            'WiUserAPI\\V1\\Rest\\Token\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ),
            ),
        ),
    ),
);
