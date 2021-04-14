<?php

namespace SlimJIM\Controllers;

use SlimJIM\Repositories\UsersRepository;

// TODO: Class is Incomplete
class UsersController
{
    // Private Variables
    private $usersRepository;

    // Constructor
    public function __construct(UsersRepository $repository)
    {
        $this->usersRepository = $repository;
    }

    // Function to List Users
    public function list($request, $response, $args)
    {
        $events = $this->usersRepository->getAll();         // <-- Change this when Users Table is created.

        $response->getBody()->write(json_encode($events));  // <-- Change this when Users Table is created.
        return $response    
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}