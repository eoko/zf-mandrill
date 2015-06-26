<?php

return [
    'service_manager' => [
        'factories' => [
            'eoko.mandrill.client' => 'Eoko\Mandrill\Client\MandrillFactory',
        ],
    ],


    'controllers' => [
        'factories' => [
            'Eoko\Mandrill\Controller\Index' => 'Eoko\Mandrill\Controller\IndexControllerFactory'
        ],
    ],


    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [
                'b' => [
                    'options' => [
                        'route'    => 'mandrill check [--verbose|-v]',
                        'defaults' => [
                            'controller' => 'Eoko\Mandrill\Controller\Index',
                            'action'        => 'keyValidation',
                        ],
                    ],
                ]
            ],
        ],
    ],
];
