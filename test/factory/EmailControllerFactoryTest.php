<?php

namespace Eoko\Mandrill\Test\Factory;

use Eoko\Mandrill\Controller\EmailController;
use Eoko\Mandrill\Factory\EmailControllerFactory;
use Eoko\Mandrill\Test\Bootstrap;

class EmailControllerFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        $controller = (new EmailControllerFactory())->createService(Bootstrap::getServiceManager());
        $this->assertInstanceOf(EmailController::class, $controller);
    }
}
