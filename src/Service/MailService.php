<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 26/06/15
 * Time: 19:59
 */

namespace Eoko\Mandrill\Service;

use Mandrill;
use Eoko\Mandrill\Struct\MessageStruct;
use Zend\Stdlib\Hydrator\ObjectProperty;

class MailService
{

    /** @var  Mandrill */
    protected $client;

    /** @var  string */
    protected $defaultFromEmail;

    /** @var  string */
    protected $defaultFromName;

    /** @var  string */
    protected $defaultSubaccount;

    /** @var  bool */
    protected $async;

    /** @var  null|string */
    protected $ip_pool;

    /**
     * UTC timestamp format YYYY-MM-DD HH:MM:SS
     * @var string
     */
    protected $send_at;

    public function __construct($client, $defaultSubaccount = null, $defaultFromEmail = null, $defaultFromName = null, $async = false, $ip_pool = null, $send_at = null)
    {
        $this->client = $client;
        $this->async = $async;
        $this->ip_pool = $ip_pool;
        $this->send_at = $send_at;

        // default configuration for message
        $this->defaultSubaccount = $defaultSubaccount;
        $this->defaultFromEmail = $defaultFromEmail;
        $this->defaultFromName = $defaultFromName;
    }

    public function send(MessageStruct $message)
    {
        if (is_null($message->from_email)) {
            $message->from_email = $this->defaultFromEmail;
        }

        if (is_null($message->from_name)) {
            $message->from_name = $this->defaultFromName;
        }

        if (is_null($message->subaccount)) {
            $message->subaccount = $this->defaultSubaccount;
        }

        $struct = (new ObjectProperty())->extract($message);
        return $this->client->messages->send($struct, $this->async, $this->ip_pool, $this->send_at);
    }

    /**
     * @param Mandrill $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param mixed $defaultSubaccount
     */
    public function setDefaultSubaccount($defaultSubaccount)
    {
        $this->defaultSubaccount = $defaultSubaccount;
    }

    /**
     * @param mixed $async
     */
    public function setAsync($async)
    {
        $this->async = $async;
    }

    /**
     * @param mixed $ip_pool
     */
    public function setIpPool($ip_pool)
    {
        $this->ip_pool = $ip_pool;
    }

    /**
     * @param mixed $send_at
     */
    public function setSendAt($send_at)
    {
        $this->send_at = $send_at;
    }

    /**
     * @return mixed
     */
    public function getDefaultSubaccount()
    {
        return $this->defaultSubaccount;
    }

    /**
     * @return Mandrill
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $defaultFromEmail
     */
    public function setDefaultFromEmail($defaultFromEmail)
    {
        $this->defaultFromEmail = $defaultFromEmail;
    }

    /**
     * @param string $defaultFromName
     */
    public function setDefaultFromName($defaultFromName)
    {
        $this->defaultFromName = $defaultFromName;
    }
}
