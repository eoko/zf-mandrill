<?php

namespace Eoko\Mandrill\Factory;

use Mandrill;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $key = (isset($config['eoko']['mandrill']['apiKey'])) ? $config['eoko']['mandrill']['apiKey'] : null;

        return new Mandrill($key);
    }
}
