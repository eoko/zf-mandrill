<?php

namespace Eoko\Mandrill\Factory;

use Eoko\Mandrill\Controller\EmailController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EmailControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new EmailController($serviceLocator->getServiceLocator()->get('Eoko\Mandrill\Service\Email'));
    }
}
