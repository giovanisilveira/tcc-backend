<?php
include_once 'bootstrap.php';

use Respect\Rest\Router;
use Tcc\Resource\Registry\Registry as Registry;
use Tcc\DataAccess\DAO\DAOFactory as DAOFactory;

/**
 * Registra objetos de uso comum.
 */
$registry = Registry::getInstance();
$registry->addKey("DAOFactory", new DAOFactory());

/**
 * Router Config
 */
$router = new Router();
$router->isAutoDispatched = false;

/**
 * Definição das Rotas da aplicação
 */

$router->post("/alunos/", "Tcc\Controllers\AlunosController")->accept(array('application/json' => 'json_encode'));
$router->get("/autenticar/", "Tcc\Controllers\AutenticarController")->accept(array('application/json' => 'json_encode'));

/**
 * Rotas de desenvolvimento de templates
 * Pacote Design
 */


print $router->run();
