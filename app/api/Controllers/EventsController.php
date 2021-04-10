<?php

namespace SlimJIM\Controllers;

use SlimJIM\Repositories\EventsRepository;

const FILTER_TYPE_UPCOMING = 'upcoming';

class EventsController {
    private $eventsRepository;

    public function __construct(EventsRepository $repository)
    {
        $this->eventsRepository = $repository;
    }

    public function list($request, $response, $args)
    {
        $params = $request->getQueryParams();
        $filter = $params['filter'] ?? null;

        if ($filter == FILTER_TYPE_UPCOMING) {
            $events = $this->eventsRepository->getUpcoming();
        }
        
        if (!$filter) {
            $events = $this->eventsRepository->getAll();
        }

        $response->getBody()->write(json_encode($events));
        return $response    
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

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