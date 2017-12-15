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
$router->route('test')->to(function ($message){
    var_dump($message);
});

$router->attachToMessageBus($commandBus);

$commandBus->dispatch('test');