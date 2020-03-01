<?php

namespace App\Services;

use Psr\Container\ContainerInterface;
use \Firebase\JWT\JWT as Generator;

class JWT
{
    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function getToken($canControl = false)
    {
        $payload = array(
            'canView' => true,
            'canControl' => $canControl,
            'exp' => time()+30
        );
        return Generator::encode($payload, $_ENV['JWT_KEY']);
    }
}