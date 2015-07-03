<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 26/06/15
 * Time: 19:33
 */

namespace Eoko\Mandrill\Check;

use Eoko\Mandrill\Exception\TestModeException;
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
            /** @var \Mandrill $client */
            $client = $this->getServiceLocator()->get('eoko.mandrill.client');
            if (strpos($client->apikey, '-')) {
                throw new TestModeException('You key is for test purpose.');
            }
            return new Success('Your key is valid for production.');
        } catch (TestModeException $e) {
            return new Warning($e->getMessage());
        } catch (\Exception $e) {
            return new Failure($e->getMessage());
        }
    }
}
