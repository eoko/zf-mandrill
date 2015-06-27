<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 26/06/15
 * Time: 19:33
 */

namespace Eoko\Mandrill\Check;

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
            /** @var \Mandrill $client */
            $client = $this->getServiceLocator()->get('eoko.mandrill.client');
            $client->users->info();
            return new Success('Current Key is "' . $client->apikey . '"');
        } catch (\Exception $e) {
            return new Failure($e->getMessage());
        }
    }
}
