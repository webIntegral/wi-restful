<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'WiContactAPI\\V1\\Rest\\Contact\\ContactResource' => 'WiContactAPI\\V1\\Rest\\Contact\\ContactResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'wi-contact-api.rest.contact' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/contact[/:contact_id]',
                    'defaults' => array(
                        'controller' => 'WiContactAPI\\V1\\Rest\\Contact\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'wi-contact-api.rest.contact',
        ),
    ),
    'zf-rest' => array(
        'WiContactAPI\\V1\\Rest\\Contact\\Controller' => array(
            'listener' => 'WiContactAPI\\V1\\Rest\\Contact\\ContactResource',
            'route_name' => 'wi-contact-api.rest.contact',
            'route_identifier_name' => 'contact_id',
            'collection_name' => 'contact',
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
            ),
            'page_size' => 25,
            'page_size_param' => 'page_size',
            'entity_class' => 'WiContactAPI\\V1\\Rest\\Contact\\ContactEntity',
            'collection_class' => 'WiContactAPI\\V1\\Rest\\Contact\\ContactCollection',
            'service_name' => 'Contact',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'WiContactAPI\\V1\\Rest\\Contact\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'WiContactAPI\\V1\\Rest\\Contact\\Controller' => array(
                0 => 'application/vnd.wi-contact-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'WiContactAPI\\V1\\Rest\\Contact\\Controller' => array(
                0 => 'application/vnd.wi-contact-api.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'WiContactAPI\\V1\\Rest\\Contact\\ContactEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-contact-api.rest.contact',
                'route_identifier_name' => 'contact_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WiContactAPI\\V1\\Rest\\Contact\\ContactCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'wi-contact-api.rest.contact',
                'route_identifier_name' => 'contact_id',
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
            'WiContactAPI_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    0 => 'C:\\vhosts\\restful-wi\\module\\WiContactAPI\\config/../src/WiContactAPI/V1/Rest/Contact',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'WiContactAPI' => 'WiContactAPI_driver',
                ),
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'WiContactAPI\\V1\\Rest\\Contact\\Controller' => array(
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
        ),
    ),
    'zf-content-validation' => array(
        'WiContactAPI\\V1\\Rest\\Contact\\Controller' => array(
            'input_filter' => 'WiContactAPI\\V1\\Rest\\Contact\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'WiContactAPI\\V1\\Rest\\Contact\\Validator' => array(
            0 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'name',
                'description' => 'Contact name',
                'continue_if_empty' => false,
            ),
        ),
    ),
);
