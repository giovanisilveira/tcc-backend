<?php
include_once 'bootstrap.php';

use Respect\Rest\Router;


/**
 * Router Config
 */
$router = new Router();
$router->isAutoDispatched = false;

/**
 * Definição das Rotas da aplicação
 */
$router->any("/", function() {
	$r = var_export($_POST, TRUE);
	return array("ok", $r);
})->accept(array('application/json' => 'json_encode'));

$router->any("/auth/authenticate", function() {
    try{
	$user = new stdClass();
	$user->name = 'Giovani Silveira';
	$user->nascimento = "1984-01-15";
	$user->email = strtolower($_REQUEST['email']);

	$r = var_export($_REQUEST, TRUE);
	if (empty($_REQUEST['email'])) {
		throw new RuntimeException('Não encontrado: ' . $r . ' method: ' . $_SERVER['REQUEST_METHOD']);
	}

	return array(
		'token' => uniqid(),
		'user'  => $user
	);
    }catch(Exception $e){
	header("HTTP/1.1 404 Not Found");
	return array( 
		'error' => true,
		'errorMessage' => $e->getMessage()
	);
    }
})->accept(array('application/json' => 'json_encode'));


$router->any("/resource", function() {
	header("HTTP/1.1 404 NO CONTENT");
	return array("error" => "Recurso não encontrado!");
})->accept(array('application/json' => 'json_encode'));


/**
 * Rotas de desenvolvimento de templates
 * Pacote Design
 */


print $router->run();
