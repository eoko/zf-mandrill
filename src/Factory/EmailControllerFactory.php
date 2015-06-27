<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 26/06/15
 * Time: 22:19
 */

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
        return new EmailController($serviceLocator->getServiceLocator()->get('eoko.mandrill.service.email'));
    }
}
