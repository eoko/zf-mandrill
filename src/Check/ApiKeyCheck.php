<?php

namespace Eoko\Mandrill\Check;

use Mandrill;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZendDiagnostics\Check\AbstractCheck;
use ZendDiagnostics\Result\Failure;
use ZendDiagnostics\Result\Success;

class ApiKeyCheck extends AbstractCheck implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function check()
    {
        try {
            /** @var Mandrill $client */
            $client = $this->getServiceLocator()->get(Mandrill::class);
            $result = $client->users->info();
            return new Success('Current Key is "' . $client->apikey . '"');
        } catch (\Exception $e) {
            return new Failure($e->getMessage());
        }
    }
}
