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
use React\Promise\Deferred;

class AddQueryHandler
{
    public function __invoke(AddQuery $query, Deferred $deferred)
    {
    //either use one of them
        $deferred->resolve($query->first() + $query->second());
//        $deferred->reject('dammn it');
    }
}