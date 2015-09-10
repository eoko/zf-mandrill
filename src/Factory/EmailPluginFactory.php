<?php

namespace Eoko\Mandrill\Factory;

use Eoko\Mandrill\Plugin\EmailPlugin;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EmailPluginFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->getServiceLocator()->get('Eoko\Mandrill\Service\Email');
        return new EmailPlugin($service);
    }
}
