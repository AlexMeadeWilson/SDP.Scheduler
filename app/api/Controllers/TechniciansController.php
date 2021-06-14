<?php

namespace SlimJIM\Controllers;

use SlimJIM\Repositories\TechniciansRepository;

class TechniciansController
{
    // Private Variables
    private $techniciansRepository;

    // Constructor
    public function __construct(TechniciansRepository $repository)
    {
        $this->techniciansRepository = $repository;
    }

    // Function to List Technicians
    public function list($request, $response, $args)
    {
        $technicians = $this->techniciansRepository->getAll();

        $response->getBody()->write(json_encode($technicians));
        return $response    
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}