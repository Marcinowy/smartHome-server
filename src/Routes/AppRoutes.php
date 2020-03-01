<?php

use App\Controller\AppController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function(RoutingConfigurator $routes)
{
    $routes->add('index', '/')
        ->controller([AppController::class, 'index'])
    ;
    
    $routes->add('token', '/oauth/token')
        ->controller([AppController::class, 'token'])
    ;
};