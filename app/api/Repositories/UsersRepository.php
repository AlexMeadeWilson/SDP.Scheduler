<?php

namespace SlimJIM\Repositories;

use \Illuminate\Database\Capsule\Manager;

class UsersRepository
{
    // Private Variables
    private $database;

    // Constructor
    public function __construct(Manager $manager)
    {
        $this->database = $manager;
    }

    // Function to GET Users: All
    public function getAll()
    {
        return $this->database->table('events')->get(); // <-- Change this when the Users Table is created.
    }
}