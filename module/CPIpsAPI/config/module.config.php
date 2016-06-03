<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'CPIpsAPI\\V1\\Rest\\Afiliado\\AfiliadoResource' => 'CPIpsAPI\\V1\\Rest\\Afiliado\\AfiliadoResourceFactory',
            'CPIpsAPI\\V1\\Rest\\Medico\\MedicoResource' => 'CPIpsAPI\\V1\\Rest\\Medico\\MedicoResourceFactory',
            'CPIpsAPI\\V1\\Rest\\Examen\\ExamenResource' => 'CPIpsAPI\\V1\\Rest\\Examen\\ExamenResourceFactory',
            'CPIpsAPI\\V1\\Rest\\ExamenTipo\\ExamenTipoResource' => 'CPIpsAPI\\V1\\Rest\\ExamenTipo\\ExamenTipoResourceFactory',
            'CPIpsAPI\\V1\\Rest\\ExamenParametro\\ExamenParametroResource' => 'CPIpsAPI\\V1\\Rest\\ExamenParametro\\ExamenParametroResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cp-ips-api.rest.afiliado' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/afiliado[/:afiliado_id]',
                    'defaults' => array(
                        'controller' => 'CPIpsAPI\\V1\\Rest\\Afiliado\\Controller',
                    ),
                ),
            ),
            'cp-ips-api.rest.medico' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/medico[/:medico_id]',
                    'defaults' => array(
                        'controller' => 'CPIpsAPI\\V1\\Rest\\Medico\\Controller',
                    ),
                ),
            ),
            'cp-ips-api.rest.examen' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/examen[/:examen_id]',
                    'defaults' => array(
                        'controller' => 'CPIpsAPI\\V1\\Rest\\Examen\\Controller',
                    ),
                ),
            ),
            'cp-ips-api.rest.examen-tipo' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/examen-tipo[/:examen_tipo_id]',
                    'defaults' => array(
                        'controller' => 'CPIpsAPI\\V1\\Rest\\ExamenTipo\\Controller',
                    ),
                ),
            ),
            'cp-ips-api.rest.examen-parametro' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/examen-parametro[/:examen_parametro_id]',
                    'defaults' => array(
                        'controller' => 'CPIpsAPI\\V1\\Rest\\ExamenParametro\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'cp-ips-api.rest.afiliado',
            1 => 'cp-ips-api.rest.medico',
            2 => 'cp-ips-api.rest.examen',
            3 => 'cp-ips-api.rest.examen-tipo',
            4 => 'cp-ips-api.rest.examen-parametro',
        ),
    ),
    'zf-rest' => array(
        'CPIpsAPI\\V1\\Rest\\Afiliado\\Controller' => array(
            'listener' => 'CPIpsAPI\\V1\\Rest\\Afiliado\\AfiliadoResource',
            'route_name' => 'cp-ips-api.rest.afiliado',
            'route_identifier_name' => 'afiliado_id',
            'collection_name' => 'afiliado',
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
                2 => 'tipoDocumento',
                3 => 'numeroDocumento',
            ),
            'page_size' => 25,
            'page_size_param' => 'page_size',
            'entity_class' => 'CPIpsAPI\\V1\\Rest\\Afiliado\\AfiliadoEntity',
            'collection_class' => 'CPIpsAPI\\V1\\Rest\\Afiliado\\AfiliadoCollection',
            'service_name' => 'Afiliado',
        ),
        'CPIpsAPI\\V1\\Rest\\Medico\\Controller' => array(
            'listener' => 'CPIpsAPI\\V1\\Rest\\Medico\\MedicoResource',
            'route_name' => 'cp-ips-api.rest.medico',
            'route_identifier_name' => 'medico_id',
            'collection_name' => 'medico',
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
            'page_size_param' => 'page_size',
            'entity_class' => 'CPIpsAPI\\V1\\Rest\\Medico\\MedicoEntity',
            'collection_class' => 'CPIpsAPI\\V1\\Rest\\Medico\\MedicoCollection',
            'service_name' => 'Medico',
        ),
        'CPIpsAPI\\V1\\Rest\\Examen\\Controller' => array(
            'listener' => 'CPIpsAPI\\V1\\Rest\\Examen\\ExamenResource',
            'route_name' => 'cp-ips-api.rest.examen',
            'route_identifier_name' => 'examen_id',
            'collection_name' => 'examen',
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
            'page_size_param' => 'page_size',
            'entity_class' => 'CPIpsAPI\\V1\\Rest\\Examen\\ExamenEntity',
            'collection_class' => 'CPIpsAPI\\V1\\Rest\\Examen\\ExamenCollection',
            'service_name' => 'Examen',
        ),
        'CPIpsAPI\\V1\\Rest\\ExamenTipo\\Controller' => array(
            'listener' => 'CPIpsAPI\\V1\\Rest\\ExamenTipo\\ExamenTipoResource',
            'route_name' => 'cp-ips-api.rest.examen-tipo',
            'route_identifier_name' => 'examen_tipo_id',
            'collection_name' => 'examen_tipo',
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
            'entity_class' => 'CPIpsAPI\\V1\\Rest\\ExamenTipo\\ExamenTipoEntity',
            'collection_class' => 'CPIpsAPI\\V1\\Rest\\ExamenTipo\\ExamenTipoCollection',
            'service_name' => 'ExamenTipo',
        ),
        'CPIpsAPI\\V1\\Rest\\ExamenParametro\\Controller' => array(
            'listener' => 'CPIpsAPI\\V1\\Rest\\ExamenParametro\\ExamenParametroResource',
            'route_name' => 'cp-ips-api.rest.examen-parametro',
            'route_identifier_name' => 'examen_parametro_id',
            'collection_name' => 'examen_parametro',
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
            'entity_class' => 'CPIpsAPI\\V1\\Rest\\ExamenParametro\\ExamenParametroEntity',
            'collection_class' => 'CPIpsAPI\\V1\\Rest\\ExamenParametro\\ExamenParametroCollection',
            'service_name' => 'ExamenParametro',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'CPIpsAPI\\V1\\Rest\\Afiliado\\Controller' => 'HalJson',
            'CPIpsAPI\\V1\\Rest\\Medico\\Controller' => 'HalJson',
            'CPIpsAPI\\V1\\Rest\\Examen\\Controller' => 'HalJson',
            'CPIpsAPI\\V1\\Rest\\ExamenTipo\\Controller' => 'HalJson',
            'CPIpsAPI\\V1\\Rest\\ExamenParametro\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'CPIpsAPI\\V1\\Rest\\Afiliado\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'CPIpsAPI\\V1\\Rest\\Medico\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'CPIpsAPI\\V1\\Rest\\Examen\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'CPIpsAPI\\V1\\Rest\\ExamenTipo\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'CPIpsAPI\\V1\\Rest\\ExamenParametro\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'CPIpsAPI\\V1\\Rest\\Afiliado\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/json',
            ),
            'CPIpsAPI\\V1\\Rest\\Medico\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/json',
            ),
            'CPIpsAPI\\V1\\Rest\\Examen\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/json',
            ),
            'CPIpsAPI\\V1\\Rest\\ExamenTipo\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/json',
            ),
            'CPIpsAPI\\V1\\Rest\\ExamenParametro\\Controller' => array(
                0 => 'application/vnd.cp-ips-api.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'CPIpsAPI\\V1\\Rest\\Afiliado\\AfiliadoEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.afiliado',
                'route_identifier_name' => 'afiliado_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'CPIpsAPI\\V1\\Rest\\Afiliado\\AfiliadoCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.afiliado',
                'route_identifier_name' => 'afiliado_id',
                'is_collection' => true,
            ),
            'CPIpsAPI\\V1\\Rest\\Medico\\MedicoEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.medico',
                'route_identifier_name' => 'medico_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'CPIpsAPI\\V1\\Rest\\Medico\\MedicoCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.medico',
                'route_identifier_name' => 'medico_id',
                'is_collection' => true,
            ),
            'CPIpsAPI\\V1\\Rest\\Examen\\ExamenEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.examen',
                'route_identifier_name' => 'examen_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'CPIpsAPI\\V1\\Rest\\Examen\\ExamenCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.examen',
                'route_identifier_name' => 'examen_id',
                'is_collection' => true,
            ),
            'CPIpsAPI\\V1\\Rest\\ExamenTipo\\ExamenTipoEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.examen-tipo',
                'route_identifier_name' => 'examen_tipo_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'CPIpsAPI\\V1\\Rest\\ExamenTipo\\ExamenTipoCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.examen-tipo',
                'route_identifier_name' => 'examen_tipo_id',
                'is_collection' => true,
            ),
            'CPIpsAPI\\V1\\Rest\\ExamenParametro\\ExamenParametroEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.examen-parametro',
                'route_identifier_name' => 'examen_parametro_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'CPIpsAPI\\V1\\Rest\\ExamenParametro\\ExamenParametroCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'cp-ips-api.rest.examen-parametro',
                'route_identifier_name' => 'examen_parametro_id',
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
            'CPIpsAPI_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    0 => 'C:\\vhosts\\restful-wi\\module\\CPIpsAPI\\config/../src/CPIpsAPI/V1/Rest/Afiliado',
                    1 => 'C:\\vhosts\\restful-wi\\module\\CPIpsAPI\\config/../src/CPIpsAPI/V1/Rest/Medico',
                    2 => 'C:\\vhosts\\restful-wi\\module\\CPIpsAPI\\config/../src/CPIpsAPI/V1/Rest/Examen',
                    3 => 'C:\\vhosts\\restful-wi\\module\\CPIpsAPI\\config/../src/CPIpsAPI/V1/Rest/ExamenTipo',
                    4 => 'C:\\vhosts\\restful-wi\\module\\CPIpsAPI\\config/../src/CPIpsAPI/V1/Rest/ExamenParametro',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'CPIpsAPI' => 'CPIpsAPI_driver',
                ),
            ),
        ),
    ),
    'zf-content-validation' => array(
        'CPIpsAPI\\V1\\Rest\\Afiliado\\Controller' => array(
            'input_filter' => 'CPIpsAPI\\V1\\Rest\\Afiliado\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'CPIpsAPI\\V1\\Rest\\Afiliado\\Validator' => array(
            0 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'numeroDocumento',
                'continue_if_empty' => true,
                'allow_empty' => true,
            ),
            1 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'tipoDocumento',
                'continue_if_empty' => true,
                'allow_empty' => true,
            ),
        ),
    ),
);
