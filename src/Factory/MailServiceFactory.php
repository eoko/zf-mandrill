<?php

namespace Eoko\Mandrill\Factory;

use Eoko\Mandrill\Service\MailService;
use Mandrill;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MailServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $client = $serviceLocator->get(Mandrill::class);

        $config = $serviceLocator->get('Config');
        $config = $config['eoko']['mandrill'];

        $mailService = new MailService($client);

        if (isset($config['default']['subaccount'])) {
            $mailService->setDefaultSubaccount($config['default']['subaccount']);
        }

        if (isset($config['default']['from_email'])) {
            $mailService->setDefaultFromEmail($config['default']['from_email']);
        }

        if (isset($config['default']['from_name'])) {
            $mailService->setDefaultFromName($config['default']['from_name']);
        }

        if (isset($config['async'])) {
            $mailService->setAsync((boolean)$config['async']);
        }

        if (isset($config['ip_pool'])) {
            $mailService->setIpPool($config['ip_pool']);
        }

        if (isset($config['send_at'])) {
            $mailService->setSendAt($config['send_at']);
        }

        return $mailService;
    }
}
