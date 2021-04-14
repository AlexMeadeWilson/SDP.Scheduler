<?php 

namespace SlimJIM;

use DI\Container;
use SlimJIM\Controllers\EventsController;
use SlimJIM\Repositories\EventsRepository;
use SlimJIM\Controllers\UsersController;
use SlimJIM\Repositories\UsersRepository;

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

        // Repository: Users
        $this->container->set('UsersRepository', function($container)
        {
            return new UsersRepository(
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

        // Controller: Users
        $this->container->set('UsersController', function($container)
        {
            return new UsersController(
               $container->get('UsersRepository')
            );
        });
    }

}