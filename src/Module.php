<?php
namespace Eoko\Mandrill;

use Eoko\Mandrill\Listener\SendEmailListener;
use SlmQueue\Queue\QueuePluginManager;
use Zend\I18n\Translator\Translator;
use Zend\Mvc\MvcEvent;
use Zend\View\Renderer\PhpRenderer;

class Module
{

    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getTarget()->getEventManager();
        /** @var QueuePluginManager $qpm */
        $qpm = $event->getApplication()->getServiceManager()->get(QueuePluginManager::class);
        $renderer = $event->getApplication()->getServiceManager()->get(PhpRenderer::class);
        $eventManager->attach(new SendEmailListener($qpm, $renderer));

        /** @var Translator $a */
        $a = $event->getApplication()->getServiceManager()->get('mvctranslator');
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/',
                ],
            ],
        ];
    }
}
