<?php

namespace SlimJIM\Controllers;

use SlimJIM\Repositories\UsersRepository;


class UsersController {
    private $usersRepository;

    public function __construct(UsersRepository $repository)
    {
        $this->usersRepository = $repository;
    }

    public function list($request, $response, $args)
    {
        $events = $this->usersRepository->getAll();

        $response->getBody()->write(json_encode($events));
        return $response    
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}