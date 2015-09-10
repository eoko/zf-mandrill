<?php

namespace Eoko\Mandrill\Job;

use Eoko\Mandrill\Service\MailService;
use SlmQueue\Job\AbstractJob;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\I18n\Translator\TranslatorAwareTrait;
use Eoko\Mandrill\Model\Email;
use Zend\View\Renderer\RendererInterface;

class SendEmailJob extends AbstractJob implements TranslatorAwareInterface
{

    use TranslatorAwareTrait;

    protected $content;

    /** @var  MailService */
    protected $emailService;

    /** @var  RendererInterface */
    protected $renderer;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Execute the job
     *
     * @throws \Exception
     */
    public function execute()
    {
        $message = $this->getContent();

        if (!$this->emailService->send($message)) {
            throw new \Exception('snif');
        }
    }

    /**
     * @return Email
     */
    public function getContent()
    {
        return parent::getContent();
    }
}
