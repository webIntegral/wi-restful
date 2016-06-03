<?php
namespace WiBase;

return array(
    'controllers' => array(
        'invokables' => array(
            'WiBase\Controller\Index' => 'WiBase\Controller\IndexController'
        )
    ),
    'router' => array(
        'routes' => array(
            'wi-base' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/index',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'WiBase\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'WiBase' => __DIR__ . '/../view'
        )
    ),
    
    // Layout configuration
    'module_layouts' => array(
        'WiBase' => array(
            'default' => 'layout/default'
        )
    ),
    
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'WiBase_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                )
            ),
            
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'WiBase\Entity' => 'WiBase_driver'
                )
            )
        )
    )
);
