<?php

namespace SlimJIM\Controllers;

use SlimJIM\Repositories\EventsRepository;

// Static Variables
const FILTER_TYPE_OVERDUE = 'overdue';
const FILTER_TYPE_TODAY = 'today';
const FILTER_TYPE_UPCOMING = 'upcoming';

class EventsController 
{
    // Private Variables
    private $eventsRepository;

    // Constructor
    public function __construct(EventsRepository $repository)
    {
        $this->eventsRepository = $repository;
    }

    // Function to List Events
    public function list($request, $response, $args)
    {
        $params = $request->getQueryParams();
        $filter = $params['filter'] ?? null;

        // GET Events List: All
        if (!$filter)
        {
            $events = $this->eventsRepository->getAll();
        }

        // GET Events List: Overdue
        if ($filter == FILTER_TYPE_OVERDUE)
        {
            $events = $this->eventsRepository->getOverdue();
        }

        // GET Events List: Today
        if ($filter == FILTER_TYPE_TODAY)
        {
            $events = $this->eventsRepository->getToday();
        }

        // GET Events List: Upcoming
        if ($filter == FILTER_TYPE_UPCOMING)
        {
            $events = $this->eventsRepository->getUpcoming();
        }    

        $response->getBody()->write(json_encode($events));
        return $response    
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    // Function to CREATE Events
    public function create($request, $response, $args)
    {
        $payload = $request->getParsedBody();

        $result = $this->eventsRepository->create($payload);

        $response->getBody()->write(json_encode([
            'success' => $result
        ]));

        return $response    
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }

    // Function to UPDATE Events
    public function update($request, $response, $args)
    {
        $payload = $request->getParsedBody();

        $result = $this->eventsRepository->update(
            $args['id'],
            $payload
        );

        $response->getBody()->write(json_encode([
            'success' => $result
        ]));

        return $response    
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }

    // Function to DELETE Events
    public function delete($request, $response, $args)
    {
        $result = $this->eventsRepository->delete($args['id']);

        $response->getBody()->write(json_encode([
            'success' => $result
        ]));

        return $response    
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}