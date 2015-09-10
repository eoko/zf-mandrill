<?php

namespace Eoko\Mandrill\Test\Check;

use Eoko\Mandrill\Check\ApiKeyCheck;
use Eoko\Mandrill\Test\Bootstrap;
use Mandrill;
use Mandrill_Users;
use ZFTool\Diagnostics\Runner;

class ApiKeyCheckTest extends \PHPUnit_Framework_TestCase
{

    private function getApiCheck($valid = true)
    {
        $serviceManager = Bootstrap::getServiceManager();
        $serviceManager->setAllowOverride(true);

        $mandrill = \Mockery::mock(Mandrill::class);
        $users = \Mockery::mock(Mandrill_Users::class);

        if ($valid) {
            $users->shouldReceive('info')->andReturn(true);
        } else {
            $users->shouldReceive('info')->andThrow(new \Mandrill_Error());
        }
        $mandrill->users = $users;

        $serviceManager->setService(Mandrill::class, $mandrill);
        $apiCheck = $serviceManager->get(ApiKeyCheck::class);
        $apiCheck->setServiceLocator($serviceManager);
        return $apiCheck;
    }


    public function testCheckValid()
    {
        $runner = new Runner();
        $runner->addCheck($this->getApiCheck());
        $result = $runner->run();

        $this->assertEquals(1, $result->getSuccessCount());
        $this->assertEquals(0, $result->getWarningCount());
        $this->assertEquals(0, $result->getFailureCount());
    }

    public function testCheckFailure()
    {
        $runner = new Runner();
        $runner->addCheck($this->getApiCheck(false));
        $result = $runner->run();

        $this->assertEquals(0, $result->getSuccessCount());
        $this->assertEquals(0, $result->getWarningCount());
        $this->assertEquals(1, $result->getFailureCount());
    }
}
