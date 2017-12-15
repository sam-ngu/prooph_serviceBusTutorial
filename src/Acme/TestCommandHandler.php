<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 15/12/2017
 * Time: 12:12 PM
 */

namespace Acme;

class TestCommandHandler
{
    public function __invoke(TestCommand $command)
    {
        var_dump($command->payload());
    }



}