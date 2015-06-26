<?php

namespace Eoko\Mandrill\Controller;

use Eoko\Console\Helper\MessageHelper;
use Exception;
use Mandrill;
use Mandrill_Invalid_Key;
use Zend\Console\Prompt\Line;
use Zend\Mvc\Controller\AbstractConsoleController;

class IndexController extends AbstractConsoleController
{
    /** @var  Mandrill */
    protected $client;

    /** @var string */
    protected $verbose;

    public function __construct($client, $verbose = '')
    {
        MessageHelper::$verbosity = $verbose;
        $this->verbose = $verbose;
        $this->client = $client;
    }

    public function keyValidationAction()
    {
        while (1) {
            try {
                $this->client->users->ping();
                $this->message()->show('[success]The mandrill Api Key is valid[/success].' . "\n" . '[v][danger]Your key is {{key}}[/danger][/v]',
                    ['key' => $this->client->apikey]
                );
                break;
            } catch (Mandrill_Invalid_Key $e) {
                $this->message()->show('[danger]Mandrill is not properly configured[/danger]');
                $this->client->apikey = (new Line("Please enter another API key (press ENTER to quit) : "))->show();
            } catch (Exception $e) {
                $this->message()->show('[danger]{{message}}[/danger]', ['message' => $e->getMessage()]);
                break;
            }
        }
    }
}
