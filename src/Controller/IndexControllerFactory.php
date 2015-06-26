<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 26/06/15
 * Time: 17:43
 */

namespace Eoko\Mandrill\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $client = $serviceLocator->getServiceLocator()->get('eoko.mandrill.client');
        $verbosity = ($serviceLocator->getServiceLocator()->get('Request')->getParams('v')) ? 'v' : null;

        if (is_null($verbosity)) {
            $verbosity = $serviceLocator->getServiceLocator()->get('Request')->getParams('v', '');
        }

        return new IndexController($client, $verbosity);
    }
}
