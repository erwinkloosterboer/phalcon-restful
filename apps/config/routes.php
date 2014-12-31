<?php
$router = new \Phalcon\Mvc\Router();
$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
$router->removeExtraSlashes(TRUE);

/*$router->notFound(array(
	"module" 		=> "frontend",
    "controller" 	=> "index",
    "action" 		=> "route404"
));

/**
 * Default Routes
 * */
$router->setDefaultModule("api");
$router->setDefaultController("api");

//$router->add("/api/crud/:params", array(
//	'module' 		=> 'api',
//	'controller' 	=> 'crud',
//	'action' 		=> 'index',
//	'params'		=> 1
//));

$router->add("/{resource}", array(
	'module' 		=> 'api',
	'controller' 	=> 'api',
	'action' 		=> 'index',
));

$router->add("/{resource}/{id}.*", array(
	'module' 		=> 'api',
	'controller' 	=> 'api',
	'action' 		=> 'index',
));

//$router->add('/user/:action',array(
//	'module' 		=> 'frontend',
//	'controller' 	=> 'user',
//	'action' 		=> '1'
//));
//$router->add('/galeria/:action',array(
//	'module' 		=> 'frontend',
//	'controller' 	=> 'galeria',
//	'action' 		=> '1'
//));