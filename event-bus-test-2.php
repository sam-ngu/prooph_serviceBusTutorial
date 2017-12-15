<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 15/12/2017
 * Time: 1:22 PM
 */

require 'vendor/autoload.php';

$eventBus = new \Prooph\ServiceBus\EventBus();

$router = new \Prooph\ServiceBus\Plugin\Router\EventRouter();
$router
    ->route(\Acme\SomethingHappened::class)
    ->to(function (\Acme\SomethingHappened $event){
    var_dump($event->payload());
    })
    ->andTo(function (\Acme\SomethingHappened $event){
        echo $event->messageName() . 'called, too';
    });

$router->attachToMessageBus($eventBus);

$eventBus->dispatch(new \Acme\SomethingHappened(['1'=>'2']));


