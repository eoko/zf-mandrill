<?php

use Eoko\Mandrill\Check\ApiKeyCheck;
use Eoko\Mandrill\Check\ApiKeyCheckDev;
use Eoko\Mandrill\Check\SubaccountCheck;
use Mandrill as MandrillClient;

return [
    'service_manager' => [
        'factories' => [
             MandrillClient::class => 'Eoko\Mandrill\Factory\ClientFactory',
            'Eoko\Mandrill\Service\Email' => 'Eoko\Mandrill\Factory\MailServiceFactory',
        ],
        'invokables' => [
            ApiKeyCheck::class => ApiKeyCheck::class,
            ApiKeyCheckDev::class => ApiKeyCheckDev::class,
            SubaccountCheck::class => SubaccountCheck::class,
        ],
        'delegators' => [
            'MvcTranslator' => [
                'Eoko\Mandrill\Delegator\TranslatorDelegator',
            ],
        ],
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

    'slm_queue' => [
        'queue_manager' => [
            'factories' => [
                'user' => 'SlmQueueSqs\Factory\SqsQueueFactory'
            ]
        ],
        'queues' => [
            'user' => [
                'queueUrl' => 'https://sqs.eu-west-1.amazonaws.com/591955746157/demo'
            ]
        ],
        'job_manager' => [
            'factories' => [
                'Eoko\Mandrill\Job\SendEmailJob' => 'Eoko\Mandrill\Factory\SendEmailJobFactory',
            ],
        ],
    ],


    'diagnostics' => [
        'Eoko' => [
            'Mandrill ApiKey' => ApiKeyCheck::class,
            'Mandrill Dev Mode' => ApiKeyCheckDev::class,
            'Mandrill Subaccount' => SubaccountCheck::class,
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
