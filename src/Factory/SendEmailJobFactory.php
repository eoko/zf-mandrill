<?php

namespace Eoko\Mandrill\Factory;

use Eoko\Mandrill\Job\SendEmailJob;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;

class SendEmailJobFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $emailService = $serviceLocator->get('Eoko\Mandrill\Service\Email');
        /** @var RendererInterface $translator */
        $renderer = $serviceLocator->get(PhpRenderer::class);

        return new SendEmailJob($emailService, $renderer);
    }
}
