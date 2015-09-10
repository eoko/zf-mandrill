<?php

namespace Eoko\Mandrill\Check;

use Eoko\Mandrill\Service\MailService;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZendDiagnostics\Check\AbstractCheck;
use ZendDiagnostics\Result\Failure;
use ZendDiagnostics\Result\Success;
use ZendDiagnostics\Result\Warning;

class SubaccountCheck extends AbstractCheck implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function check()
    {
        try {
            /** @var MailService $service */
            $service = $this->getServiceLocator()->get('Eoko\Mandrill\Service\Email');

            $subaccount = $service->getDefaultSubaccount();

            if (empty($subaccount)) {
                return new Warning('No subaccount set.');
            }

            $result = $service->getClient()->subaccounts->getList($subaccount);

            if (empty($result)) {
                return new Failure('Current subaccount does not exist : ' . $subaccount);
            }

            if (!is_int(array_search($subaccount, array_column($result, 'name'), true))) {
                return new Warning('Current subaccount is not exactly present : ' . $subaccount);
            }

            return new Success('Current subaccount is "' . $subaccount . '"');
        } catch (\Exception $e) {
            return new Failure($e->getMessage());
        }
    }
}
