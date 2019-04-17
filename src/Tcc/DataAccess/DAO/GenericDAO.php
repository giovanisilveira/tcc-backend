<?php
namespace Tcc\DataAccess\DAO;

use Tcc\Resource\Registry\Registry as Registry;

abstract class GenericDAO
{
    /**
     * Objeto com a conexão com a base de dados iniciada.
     * @var PDO
     */
    protected $pdo;

    protected $registry;

    /**
     * Atribui o objeto PDO ao atributo de conexão
     * @param \PDO $pdo 
     */
    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
        $this->registry = Registry::getInstance();
    }
}