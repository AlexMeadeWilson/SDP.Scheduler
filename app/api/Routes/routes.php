<?php

// Route: '/' - Root - Calls the Scheduler UI
$app->get('/', function ($request, $response, $args)
{
    $view = file_get_contents('./front-end/scheduler.html');
    $response->getBody()->write($view);
    return $response;
});

registerEvents($app);
registerTechnicians($app);

// Technicians Service - All Technicians Routes
function registerTechnicians(&$app)
{
    // Route: '/api/technicians' - GET Technicians List: All
    $app->get('/api/technicians', function ($request, $response, $args)
    {
        return $this->get('TechniciansController')->list($request, $response, $args);
    });
}

// Events (Jobs) Service - All Events (Jobs) Routes
function registerEvents(&$app)
{
    // Route: '/api/events' - GET Events List: All
    $app->get('/api/events', function ($request, $response, $args)
    {
        return $this->get('EventsController')->list($request, $response, $args);
    });

    // Route: '/api/events/{id}' - GET Events by ID
    $app->get('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->get($request, $response, $args);
    });

    // Route: '/api/events' - Create (POST) New Events
    $app->post('/api/events', function ($request, $response, $args)
    {
        return $this->get('EventsController')->create($request, $response, $args);
    });

    // Route: '/api/events/{id}' - Update (POST) Events by ID
    $app->post('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->update($request, $response, $args);
    });

    // Route: '/api/events/{id}' - DELETE Events by ID
    $app->delete('/api/events/{id}', function ($request, $response, $args)
    {
        return $this->get('EventsController')->delete($request, $response, $args);
    });
}