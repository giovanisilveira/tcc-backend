<?php
namespace Tcc\DataAccess\DAO;

use Tcc\DataAccess\DAO\PDOConnectionFactory as PDOConnectionFactory;

class DAOFactory
{
    private $connection = array();
    public function __construct() {
        $this->connection['Tcc'] = PDOConnectionFactory::getConnection('Tcc');
    }

    public function getTccConnection() {
        return $this->connection['Tcc'];
    }

    public function createAlunosDAO()
    {
        return new AlunosDAO($this->connection['Tcc']);
    }
}
