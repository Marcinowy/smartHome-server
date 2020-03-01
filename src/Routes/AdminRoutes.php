<?php

use App\Controller\AdminController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function(RoutingConfigurator $routes)
{
    $routes->add('ajaxURL', '/ajax')
        ->controller([AdminController::class, 'ajax'])
        ->methods(['POST'])
    ;
    
    $routes->add('users', '/users')
        ->controller([AdminController::class, 'users'])
    ;
    $routes->add('addUser', '/users/add')
        ->controller([AdminController::class, 'addUser'])
    ;
    $routes->add('deleteUser', '/users/delete/{id}')
        ->controller([AdminController::class, 'deleteUser'])
    ;

    $routes->add('devices', '/devices')
        ->controller([AdminController::class, 'devices'])
    ;
    $routes->add('addDevice', '/devices/add')
        ->controller([AdminController::class, 'addDevice'])
    ;
    $routes->add('deleteDevice', '/devices/delete/{id}')
        ->controller([AdminController::class, 'deleteDevice'])
    ;

    $routes->add('configurate', '/configurate')
        ->controller([AdminController::class, 'configurate'])
    ;
    $routes->add('addMapConfigurate', '/configurate/map/add')
        ->controller([AdminController::class, 'addMapConfigurate'])
    ;
    $routes->add('deleteMapConfigurate', '/configurate/map/delete/{id}')
        ->controller([AdminController::class, 'deleteMapConfigurate'])
    ;
    $routes->add('addWindowConfigurate', '/configurate/window/add')
        ->controller([AdminController::class, 'addWindowConfigurate'])
    ;
    $routes->add('deleteWindowConfigurate', '/configurate/window/delete/{id}')
        ->controller([AdminController::class, 'deleteWindowConfigurate'])
    ;
};