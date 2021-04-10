<?php 

namespace SlimJIM;

use DI\Container;
use SlimJIM\Controllers\EventsController;
use SlimJIM\Repositories\EventsRepository;
use SlimJIM\Controllers\UsersController;
use SlimJIM\Repositories\UsersRepository;

class ServiceProvider {
    private $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function build(): Container 
    {
        $this->buildDatabase();
        $this->buildRepositories();
        $this->buildControllers();

        return $this->container;
    }

    private function buildDatabase()
    {
        $config = require(__DIR__ .'/Config/database.php');

        $this->container->set('db', function($container) use($config) {

            $capsule = new \Illuminate\Database\Capsule\Manager;
            $capsule->addConnection($config['settings']['db']);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        });
    }

    private function buildRepositories()
    {
        $this->container->set('EventsRepository', function($container) {
            return new EventsRepository(
                $container->get('db')
            );
        });

        $this->container->set('UsersRepository', function($container) {
            return new UsersRepository(
                $container->get('db')
            );
        });
    }

    private function buildControllers()
    {
        $this->container->set('EventsController', function($container) {
            return new EventsController(
               $container->get('EventsRepository')
            );
        });

        $this->container->set('UsersController', function($container) {
            return new UsersController(
               $container->get('UsersRepository')
            );
        });
    }

}