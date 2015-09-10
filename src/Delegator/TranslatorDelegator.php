<?php

namespace Eoko\Mandrill\Delegator;

use Zend\I18n\Translator\Translator;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TranslatorDelegator implements DelegatorFactoryInterface
{
    public function createDelegatorWithName(
        ServiceLocatorInterface $services,
        $name,
        $requestedName,
        $callback
    ) {
        /** @var Translator $translator */
        $translator = $callback();

        $translator->addTranslationFilePattern(
            'gettext',
            __DIR__ . '/../../../language',
            '%s.mo'
        );

        return $translator;
    }
}
