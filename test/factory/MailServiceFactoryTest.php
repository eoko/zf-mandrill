<?php

namespace Eoko\Mandrill\Test\Factory;

use Eoko\Mandrill\Factory\MailServiceFactory;
use Eoko\Mandrill\Service\MailService;
use Eoko\Mandrill\Test\Bootstrap;

class MailServiceFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testFactory()
    {
        $mailService = (new MailServiceFactory())->createService(Bootstrap::getServiceManager());
        $this->assertInstanceOf(MailService::class, $mailService);
    }
}
