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
    ->to(\Acme\SomethingHappenedHandler2::class)
    ->andTo(function (\Acme\SomethingHappened $event){
        echo $event->messageName() . 'called, too';
    });

$router->attachToMessageBus($eventBus);

//this is to prevent creation of new instances for every command, as in example command-bus-test-2
$container = new class implements \Psr\Container\ContainerInterface {
    public function get($id)
    {
        switch ($id){
            case \Acme\SomethingHappenedHandler2::class:
                return new \Acme\SomethingHappenedHandler2();
                break;
        }
    }

    public function has($id)
    {
        return true;
    }

};

$serviceLocatorPlugin = new \Prooph\ServiceBus\Plugin\ServiceLocatorPlugin($container);
$serviceLocatorPlugin->attachToMessageBus($eventBus);

$onEventHandlerStrategy = new \Prooph\ServiceBus\Plugin\InvokeStrategy\OnEventStrategy();
//$onEventHandlerStrategy->attachToMessageBus($eventBus);

$eventBus->dispatch(new \Acme\SomethingHappened(['1'=>'2']));


