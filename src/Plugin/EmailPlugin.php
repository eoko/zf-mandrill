<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 27/06/15
 * Time: 15:58
 */

namespace Eoko\Mandrill\Plugin;

use Eoko\Mandrill\Service\MailService;
use Eoko\Mandrill\Struct\MessageStruct;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class EmailPlugin extends AbstractPlugin
{
    /** @var  MailService */
    protected $service;

    /** @var  MessageStruct */
    protected $message;

    public function __construct($service)
    {
        $this->service = $service;
        $this->message = new MessageStruct();
    }

    public function send()
    {
        return $this->service->send($this->message);
    }

    public function subject($subject)
    {
        $this->message->subject = $subject;
        return $this;
    }

    public function text($text)
    {
        $this->message->text = $text;
        return $this;
    }

    public function html($html)
    {
        $this->message->html = $html;
        return $this;
    }

    /**
     * @param string|array $from Can be a simple email string or an array with email and name key
     * @return $this
     */
    public function from($from = ['email' => null, 'name' => null])
    {
        if (is_string($from)) {
            $this->message->from_email = $from;
        } elseif (is_array($from)) {
            $this->message->from_email = $from['email'];
            $this->message->from_name = $from['name'];
        }
        return $this;
    }

    /**
     * @param string|array $to Can be a simple email string or an array of array with email, name & type key
     * @return $this
     */
    public function to($to)
    {
        // We cast to array for simple string to
        $to = (array)$to;

        foreach ($to as $email) {
            if (is_string($email)) {
                $email = ['email' => $email];
            }
            $this->message->to[] = $email;
        }

        return $this;
    }

    public function tags($tags)
    {
        $this->message->setTags($tags);
        return $this;
    }
}
