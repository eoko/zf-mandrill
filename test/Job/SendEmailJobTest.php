<?php

namespace Eoko\Mandrill\Test\Job;

use Eoko\Mandrill\Job\SendEmailJob;
use Eoko\Mandrill\Test\Bootstrap;

class SendEmailJobTest extends \PHPUnit_Framework_TestCase
{


    public function testExecute()
    {
        /** @var SendEmailJob $job */
        $job = Bootstrap::getJobServiceManager()->get(SendEmailJob::class);
        $this->assertInstanceOf(SendEmailJob::class, $job);
    }
}
