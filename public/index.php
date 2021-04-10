<?php

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use SlimJIM\ServiceProvider;

$serviceProvider = new ServiceProvider();
AppFactory::setContainer(
    $serviceProvider->build()
);

$app = AppFactory::create();

require __DIR__ . '/../app/api/Routes/routes.php';

$app->run();