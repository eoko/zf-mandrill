<?php

return [
    'service_manager' => [
        'factories' => [
            'eoko.mandrill.client' => 'Eoko\Mandrill\Factory\ClientFactory',
            'eoko.mandrill.service.email' => 'Eoko\Mandrill\Factory\MailServiceFactory',
        ],
        'invokables' => [
            'eoko.mandrill.check.apikey' => 'Eoko\Mandrill\Check\ApiKeyCheck',
            'eoko.mandrill.check.subaccount' => 'Eoko\Mandrill\Check\SubaccountCheck',
            'eoko.mandrill.check.apiKeyCheckDev' => 'Eoko\Mandrill\Check\ApiKeyCheckDev',
            'eoko.mandrill.check.email' => 'Eoko\Mandrill\Check\EmailCheck',
        ]
    ],

    'controllers' => [
        'factories' => [
            'Eoko\Mandrill\Controller\Email' => 'Eoko\Mandrill\Factory\EmailControllerFactory'
        ],
    ],

    'controller_plugins' => [
        'factories' => [
            'Email' => 'Eoko\Mandrill\Plugin\EmailPluginFactory',
        ]
    ],

    'diagnostics' => [
        'Eoko' => [
            'Mandrill ApiKey' => 'eoko.mandrill.check.apikey',
            'Mandrill Dev Mode' => 'eoko.mandrill.check.apiKeyCheckDev',
            'Mandrill Subaccount' => 'eoko.mandrill.check.subaccount',
        ]
    ],

    'console' => [
        'router' => [
            'routes' => [
                'send_email' => [
                    'options' => [
                        'route'    => 'mandrill send email <to> <subject> <html> [--from=] [--tags=]',
                        'defaults' => [
                            'controller' => 'Eoko\Mandrill\Controller\Email',
                            'action'     => 'send'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
