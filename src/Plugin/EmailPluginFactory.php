<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 27/06/15
 * Time: 16:18
 */

namespace Eoko\Mandrill\Plugin;

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
        $service = $serviceLocator->getServiceLocator()->get('eoko.mandrill.service.email');
        return new EmailPlugin($service);
    }
}
