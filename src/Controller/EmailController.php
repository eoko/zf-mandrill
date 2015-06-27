<?php

namespace Eoko\Mandrill\Controller;

use Eoko\Mandrill\Plugin\EmailPlugin;
use Zend\Mvc\Controller\AbstractConsoleController;

class EmailController extends AbstractConsoleController
{
    public function sendAction()
    {
        /** @var EmailPlugin $email */
        $email = $this->email();

        $html = (string)$this->params('html');

        if (file_exists($html)) {
            $html = file_get_contents($html);
        }

        try {
            $result = $email->to($this->params('to'))
                ->from($this->params('from'))
                ->subject($this->params('subject'))
                ->html($html)
                ->tags(array_map('trim', explode(';', (string)$this->params('tags'))))
                ->send();

            if (empty($result)) {
                $this->message()->danger('No email sent');
            } elseif ($result[0]['status'] === 'queued') {
                $this->message()->warn('Your email is in queue.');
            } elseif ($result[0]['status'] === 'sent') {
                $this->message()->success('You email is sent');
            } else {
                $this->message()->show('[danger]Something went wrong. Details : ' . "\n" . print_r($result, true));
            }
        } catch (\Exception $e) {
            $this->message()->show('[danger]Something went wrong. Details : ' . $e->getMessage() . '[/danger]');
        }
    }
}
