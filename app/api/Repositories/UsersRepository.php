<?php

namespace SlimJIM\Repositories;

use \Illuminate\Database\Capsule\Manager;

class UsersRepository
{
    private $database;

    public function __construct(Manager $manager)
    {
        $this->database = $manager;
    }

    public function getAll()
    {
        return $this->database->table('events')->get();
    }
}