<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15-12-2017
 * Time: 8:30 AM
 */

require 'vendor/autoload.php';

$commandBus = new \Prooph\ServiceBus\CommandBus();

$router = new \Prooph\ServiceBus\Plugin\Router\CommandRouter();
$router->route('test')->to(new \Acme\TestCommandHandler());

$router->attachToMessageBus($commandBus);

$commandBus->dispatch(new \Acme\TestCommand(['foo' => 'bar']));