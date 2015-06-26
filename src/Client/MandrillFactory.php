<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 16/06/15
 * Time: 21:45
 */

namespace Eoko\Mandrill\Client;

use Mandrill;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MandrillFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('configuration');
        $key = (isset($config['eoko']['mandrill']['apiKey'])) ? $config['eoko']['mandrill']['apiKey'] : null;

        return new Mandrill($key);
    }
}
