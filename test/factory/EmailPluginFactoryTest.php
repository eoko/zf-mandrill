<?php

namespace Eoko\Mandrill\Test\Factory;

use Eoko\Mandrill\Factory\EmailPluginFactory;
use Eoko\Mandrill\Plugin\EmailPlugin;
use Eoko\Mandrill\Test\Bootstrap;
use Zend\ServiceManager\ServiceManager;

class EmailPluginFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testFactory()
    {
        $parentServiceManager = \Mockery::mock(ServiceManager::class);
        $parentServiceManager->shouldReceive('getServiceLocator')->andReturn(Bootstrap::getServiceManager());
        $service = (new EmailPluginFactory())->createService($parentServiceManager);
        $this->assertInstanceOf(EmailPlugin::class, $service);
    }
}
