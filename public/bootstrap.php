<?php
ini_set("memory_limit", "128M");
ini_set('display_errors', 1);


error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR.utf-8');

chdir(__DIR__ . '/..');
define("CONF_FILE", "conf/config.ini");
define("HASH_SENHA", "TccPUCGiovani");


require 'vendor/autoload.php';


/**
 * Registra o DAOFactory de persistência da aplicação.
 */
#use MinhaMicron\DataAccess\DAO\DAOFactory as DAOFactory;
#use MinhaMicron\Session\FileSessionHandler as FileSessionHandler;
#use MinhaMicron\Resource\Registry\Registry as Registry;

#Registry::addKey("IntegraDAO", DAOFactory::getDAOFactory());
#Registry::addKey("hash","m1cr0nm1nh@");
