<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 15/12/2017
 * Time: 1:33 PM
 */

namespace Acme;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;

class SomethingHappenedHandler2
{
    public function onEvent(SomethingHappened $event)
    {
        var_dump($event->payload());
    }
}