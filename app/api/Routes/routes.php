<?php

/* GET: Hello World! */
$app->get('/', function ($request, $response, $args)
{
    $view = file_get_contents('./front-end/scheduler.html');
    $response->getBody()->write($view);
    return $response;
});

registerEvents($app);
registerUsers($app);

function registerUsers(&$app) {
    $app->get('/api/users', function ($request, $response, $args)
    {
        return $this->get('UsersController')->list($request, $response, $args);
    });
}

function registerEvents(&$app) {
    // // GET All Jobs/Events
    $app->get('/api/events', function ($request, $response, $args)
    {
        return $this->get('EventsController')->list($request, $response, $args);
    });

    $app->get('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->get($request, $response, $args);
    });

    $app->post('/api/events', function ($request, $response, $args)
    {
        return $this->get('EventsController')->create($request, $response, $args);
    });

    $app->post('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->update($request, $response, $args);
    });

    $app->delete('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->delete($request, $response, $args);
    });
}