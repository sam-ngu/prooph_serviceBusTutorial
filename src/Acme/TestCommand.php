<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15-12-2017
 * Time: 8:36 AM
 */
namespace Acme;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadTrait;

class TestCommand extends Command
{
    protected $messageName = 'test';

    use PayloadTrait;
}