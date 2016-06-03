<?php
namespace CPIps;

return array(
    'controllers' => array(
        'invokables' => array(
            'CPIps\Controller\Index' => 'CPIps\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cp-laboratorio' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/cp-laboratorio',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'CPIps\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_path_stack' => array(
            'CPIps' => __DIR__ . '/../view',
        ),
    ),
    // Layout configuration
    'module_layouts' => array(
        'CPIps' => array(
            'default' => 'layout/default',
            'cp-laboratorio' => 'layout/cp-laboratorio',
        )
    ),
);
