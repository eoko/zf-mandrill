<?php

namespace Eoko\Mandrill\Test\Factory;

use Eoko\Mandrill\Factory\ClientFactory;
use Eoko\Mandrill\Test\Bootstrap;
use Mandrill;
use Zend\ServiceManager\ServiceManager;

class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testFactorySuccess()
    {
        $factory = new ClientFactory();
        $sl = \Mockery::mock(ServiceManager::class);
        $sl->shouldReceive('get')->andReturn(Bootstrap::getServiceManager()->get('Config'));

        $client = $factory->createService($sl);
        $this->assertInstanceOf(Mandrill::class, $client);

        $sl->shouldReceive('get')->andReturn([]);

        $client = $factory->createService($sl);
        $this->assertInstanceOf(Mandrill::class, $client);
    }
}
