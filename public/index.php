<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

require_once('../app/api/load.php');

/* GET: Hello World! */
$app->get('/', function (Request $request, Response $response, $args)
{
    $view = file_get_contents('./front-end/scheduler.html');
    $response->getBody()->write($view);
    return $response;
});

$app->run();