<?php

// Load the Scheduler View
$app->get('/', function ($request, $response, $args)
{
    $view = file_get_contents('./front-end/scheduler.html');
    $response->getBody()->write($view);
    return $response;
});

registerEvents($app);
registerUsers($app);

// Users Service
function registerUsers(&$app)
{
    $app->get('/api/users', function ($request, $response, $args)
    {
        return $this->get('UsersController')->list($request, $response, $args);
    });
}

// Events Service
function registerEvents(&$app)
{
    // GET Events List: All
    $app->get('/api/events', function ($request, $response, $args)
    {
        return $this->get('EventsController')->list($request, $response, $args);
    });

    // GET Events by ID
    $app->get('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->get($request, $response, $args);
    });

    // CREATE Events
    $app->post('/api/events', function ($request, $response, $args)
    {
        return $this->get('EventsController')->create($request, $response, $args);
    });

    // UPDATE Events by ID
    $app->post('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->update($request, $response, $args);
    });

    // DELETE Events by ID
    $app->delete('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->delete($request, $response, $args);
    });
}