<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 15/12/2017
 * Time: 2:07 PM
 */

namespace Acme;

use Prooph\Common\Messaging\Query;
use Prooph\Common\Messaging\PayloadTrait;

class AddQuery extends Query
{
    use PayloadTrait;

    public function first()
    {
        return $this->payload()['first'];

    }

    public function second()
    {
        return $this->payload()['second'];
    }
}