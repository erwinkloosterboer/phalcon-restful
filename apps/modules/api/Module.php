<?php
namespace App\Modules\Api;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    protected $config;
    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector=null)
    {
        $loader = new Loader();
		

        $loader->registerNamespaces(array(
            'App\Modules\Api\Controllers' => __DIR__ . '/controllers/',
            'App\Modules\Api\Resources' => __DIR__ . '/resources/',
            'App\Library' => __DIR__ . '/../library/',
            'App\Models\Entities' => $this->getConfig()->application->modelsEntitiesDir,
        ));

        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param \Phalcon\DiInterface $di
     */
	public function registerServices($di)
    {
		$config = $this->getConfig();

		//Redefining Dispatcher
		$di['dispatcher'] = function() {
			$dispatcher = new \Phalcon\Mvc\Dispatcher();
			$dispatcher->setDefaultNamespace("App\\Modules\\Api\\Controllers");
			return $dispatcher;
		};

        //Setting UP View component
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');
            return $view;
        };
		
		//Databse Connection
        $di['db'] = function () use ($config) {
            return new DbAdapter(array(
                "host" 		=> $config->database->host,
                "username" 	=> $config->database->username,
                "password" 	=> $config->database->password,
                "dbname" 	=> $config->database->dbname,
            ));
        };
    }

    protected function getConfig(){
        if(!isset($this->config)){
            $this->config = include __DIR__ . "/../../config/constants.php";
        }
        return $this->config;
    }
}
