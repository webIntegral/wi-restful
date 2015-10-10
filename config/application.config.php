<?php
/**
 * Configuration file generated by ZF Apigility Admin
 *
 * The previous config file has been stored in ./config/application.config.old
 */
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'Application',
        'ZF\\Apigility',
        'ZF\\Apigility\\Provider',
        'AssetManager',
        'ZF\\ApiProblem',
        'ZF\\MvcAuth',
        'ZF\\OAuth2',
        'ZF\\Hal',
        'ZF\\ContentNegotiation',
        'ZF\\ContentValidation',
        'ZF\\Rest',
        'ZF\\Rpc',
        'ZF\\Versioning',
        'ZF\\DevelopmentMode',
        'ZF\OAuth2\Doctrine',
        'WiContact',
        'WiContactAPI',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
            './module',
            './module',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);
