<?php

use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$home = $loader->import(__DIR__ . '/../src/Routes/HomeRoutes.php');
$home->addPrefix('/');
$routes->addCollection($home);

$app = $loader->import(__DIR__ . '/../src/Routes/AppRoutes.php');
$app->addPrefix('/app');
$app->addNamePrefix('app.');
$routes->addCollection($app);

$admin = $loader->import(__DIR__ . '/../src/Routes/AdminRoutes.php');
$admin->addPrefix('/admin');
$admin->addNamePrefix('admin.');
$routes->addCollection($admin);

return $routes;