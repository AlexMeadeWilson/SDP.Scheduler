<?php 

namespace SlimJIM;

use DI\Container;
use SlimJIM\Controllers\EventsController;
use SlimJIM\Repositories\EventsRepository;
use SlimJIM\Controllers\TechniciansController;
use SlimJIM\Repositories\TechniciansRepository;

class ServiceProvider
{
    // Variables
    private $container;

    // Constructor
    public function __construct()
    {
        $this->container = new Container();
    }

    // Build the Container
    public function build(): Container 
    {
        $this->buildDatabase();
        $this->buildRepositories();
        $this->buildControllers();

        return $this->container;
    }

    // Database
    private function buildDatabase()
    {
        $config = require(__DIR__ .'/Config/database.php');

        $this->container->set('db', function($container) use($config) 
        {

            $capsule = new \Illuminate\Database\Capsule\Manager;
            $capsule->addConnection($config['settings']['db']);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        });
    }

    // Repositories
    private function buildRepositories()
    {
        // Repository: Events
        $this->container->set('EventsRepository', function($container)
        {
            return new EventsRepository(
                $container->get('db')
            );
        });

        // Repository: Technicians
        $this->container->set('TechniciansRepository', function($container)
        {
            return new TechniciansRepository(
                $container->get('db')
            );
        });
    }

    // Controllers
    private function buildControllers()
    {
        // Controller: Events
        $this->container->set('EventsController', function($container)
        {
            return new EventsController(
               $container->get('EventsRepository')
            );
        });

        // Controller: Technicians
        $this->container->set('TechniciansController', function($container)
        {
            return new TechniciansController(
               $container->get('TechniciansRepository')
            );
        });
    }

}