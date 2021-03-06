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
$router->route('test')->to(\Acme\TestCommandHandler::class);

$router->attachToMessageBus($commandBus);

//this is to prevent creation of new instances for every command, as in example command-bus-test-2
$container = new class implements \Psr\Container\ContainerInterface {
    public function get($id)
    {
        switch ($id){
            case \Acme\TestCommandHandler2::class:
                return new \Acme\TestCommandHandler2();
            break;
        }
    }

    public function has($id)
    {
        return true;
    }

};

$serviceLocatorPlugin = new \Prooph\ServiceBus\Plugin\ServiceLocatorPlugin($container);
$serviceLocatorPlugin->attachToMessageBus($commandBus);

$handleCommandStrategy = new \Prooph\ServiceBus\Plugin\InvokeStrategy\HandleCommandStrategy();
$handleCommandStrategy->attachToMessageBus($commandBus);

$authorizationService = new class implements \Prooph\ServiceBus\Plugin\Guard\AuthorizationService{
    public function isGranted(string $messageName, $context = null): bool
    {
        return false; //change this line to true to allow command call, else will output error
    }
};

$guard = new \Prooph\ServiceBus\Plugin\Guard\RouteGuard($authorizationService, true); //turn exposeEventMessageName on devMode, false on prod mode
$guard->attachToMessageBus($commandBus);

$commandBus->dispatch(new \Acme\TestCommand(['foo' => 'bar']));