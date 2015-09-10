<?php

namespace Eoko\Mandrill\Check;

use Exception;
use Mandrill;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZendDiagnostics\Check\AbstractCheck;
use ZendDiagnostics\Result\Failure;
use ZendDiagnostics\Result\Success;
use ZendDiagnostics\Result\Warning;

class ApiKeyCheckDev extends AbstractCheck implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function check()
    {
        try {
            /** @var Mandrill $client */
            $client = $this->getServiceLocator()->get(Mandrill::class);
            $client->users->info();

            if (strpos($client->apikey, '-')) {
                return new Warning('You key is for test purpose.');
            }
            return new Success('Your key is valid for production.');
        } catch (Exception $e) {
            return new Failure($e->getMessage());
        }
    }
}
