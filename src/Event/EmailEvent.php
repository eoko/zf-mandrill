<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 31/08/15
 * Time: 13:43
 */

namespace Eoko\Mandrill\Event;

use Eoko\Mandrill\Model\Email;

class EmailEvent extends Email
{

    const EVENT_SEND_EMAIL = 'eoko.email.event.send';
}
