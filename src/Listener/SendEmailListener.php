<?php

namespace Eoko\Mandrill\Listener;

use Eoko\Mandrill\Event\EmailEvent;
use Eoko\Mandrill\Service\MailService;
use Eoko\Mandrill\Struct\MessageStruct;
use SlmQueue\Queue\QueueInterface;
use SlmQueue\Queue\QueuePluginManager;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\View\Renderer\RendererInterface;

class SendEmailListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = [];

    /** @var  MailService */
    protected $emailService;

    /** @var  RendererInterface */
    protected $renderer;

    /** @var  QueuePluginManager */
    protected $queues;

    public function __construct($queuePluginManager, $renderer)
    {
        $this->queues = $queuePluginManager;
        $this->renderer = $renderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach('*', EmailEvent::EVENT_SEND_EMAIL, [$this, 'onSendEmail'], 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onSendEmail(Event $e)
    {
        /** @var QueueInterface $queue */
        $queue = $this->queues->get('user');
        $emailJob = $queue->getJobPluginManager()->get('Eoko\Mandrill\Job\SendEmailJob');
        $email = $e->getParams();

        $html = $this->renderer->render($email->getHtmlTemplate(), $email->getVars());
        $text = $this->renderer->render($email->getTextTemplate(), $email->getVars());

        $message = new MessageStruct();
        $message->html = $html;
        $message->text = $text;
        $message->to = $email->getTo();

        $emailJob->setContent($message);

        $queue->push($emailJob);
    }
}
