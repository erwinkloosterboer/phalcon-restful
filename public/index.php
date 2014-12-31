<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('APP_DIR', dirname(dirname(__FILE__)). '/apps/') ;

use Phalcon\Mvc\Application;
use Phalcon\Session\Adapter\Files as SessionAdapter;

try {
	
	$config = include __DIR__.'/../apps/config/constants.php';
	$di 	= new \Phalcon\DI\FactoryDefault();
	
	// Setting Application Routes
	$di->set('router', function() {
		require __DIR__.'/../apps/config/routes.php';
	    return $router;
	});
	
	// Setting URI Prefix
	$di->set('url', function(){
		$url = new \Phalcon\Mvc\Url();
	    $url->setBaseUri($config->application->baseUri);
	
	    return $url;
	});
	
	// Register Application Directories
	$loader = new \Phalcon\Loader();
	$loader->registerDirs(
		array(
			$config->application->libraryDir,
			$config->application->modelsEntitiesDir
		)
	);
	$loader->register();
	
	
    //Handle Request
    $application = new Application();
    $application->setDI($di);
	
	//Reading Modules
	require __DIR__ . '/../apps/config/modules.php';

    echo $application->handle()->getContent();


} catch (Phalcon\Exception $e) {
    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}