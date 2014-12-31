<?php
$router = new \Phalcon\Mvc\Router();
$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
$router->removeExtraSlashes(TRUE);

$router->notFound(array(
	"module" 		=> "api",
	"controller" 	=> "api",
	"action" 		=> "index"
));

/**
 * Default Routes
 */
$router->setDefaultModule("api");
$router->setDefaultController("api");

$router->add("/{resource:[A-z0-9]+}", array(
	'module' 		=> 'api',
	'controller' 	=> 'api',
	'action' 		=> 'resource',
));

$router->add("/{resource:[A-z0-9]+}/{id}.*", array(
	'module' 		=> 'api',
	'controller' 	=> 'api',
	'action' 		=> 'resource',
));
