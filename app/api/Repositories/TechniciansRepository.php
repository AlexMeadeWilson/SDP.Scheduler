<?php

namespace SlimJIM\Repositories;

use \Illuminate\Database\Capsule\Manager;

class TechniciansRepository
{
    // Private Variables
    private $database;

    // Constructor
    public function __construct(Manager $manager)
    {
        $this->database = $manager;
    }

    // Function to GET Technicians: All
    public function getAll()
    {
        return $this->database->table('technicians')->get();
    }
}