<?php

namespace Eoko\Mandrill\Test\Factory;

use Eoko\Mandrill\Factory\SendEmailJobFactory;
use Eoko\Mandrill\Test\Bootstrap;
use Zend\ServiceManager\ServiceManager;

class SendEmailJobFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testFactory()
    {
        $parentServiceManager = \Mockery::mock(ServiceManager::class);
        $parentServiceManager->shouldReceive('getServiceLocator')->andReturn(Bootstrap::getServiceManager());
        $service = (new SendEmailJobFactory())->createService($parentServiceManager);
        $this->assertInstanceOf('Eoko\Mandrill\Job\SendEmailJob', $service);
    }
}
