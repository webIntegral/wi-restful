<?php
namespace WiContacts;

return array(
    'controllers' => array(
        'invokables' => array(
            'WiContacts\Controller\Index' => 'WiContacts\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'wi-contacts' => array(
                'type'    => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/contacts[/][:action][/:id]',
                    'constraints' => array(
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'        => '[0-9]+',
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'WiContacts\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'WiContacts' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver and entity paths
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
                ),
            ),
    
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register annotation driver for any entity under module namespace
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);
