<?php
namespace Tcc\DataAccess\DAO;

use Tcc\Resource\Registry\Config;

/**
 * Classe responsável por criar instancias de PDO
 */
class PDOConnectionFactory 
{
    /**
     * Mantem o registro das instancias que foram criadas para as bases de dados definidas
     * 
     * @var array
     */
    private static $instance = array();

    private function __construct() {
    }

    /**
     * Utiliza o método de conexão para retornar uma conexão para a base de dados.
     * 
     * @param  boolean $persistent Indica se a conexão será persistente ou não.
     * @return \PDO                Retornar o objeto de conexão
     */
    public static function getConnection($configDataBase = 'DataBase', $persistent = false) {
        return self::getNewConnection($configDataBase, $persistent);
    }

    /**
     * Método responsável por pegar as configurações definidas no arquivo de 
     * configuração da aplicação e devolver uma instância de PDO conforme o grupo 
     * de configuração definido no arquivo ini. Caso haja um objeto existente para 
     * a conexão especificada, este objeto será retornado do registro.
     * 
     * @param  string  $configDataBase Nome do grupo de configuração correspondente a base de dados 
     *                                 que deseja-se conectar, localizada no arquivo ini defindo no bootstrap.
     * @param  boolean $persistent     Indica se a conexão é persistente ou não
     * @return \PDO                    Retorna uma instância de PDO
     */
    private static function getNewConnection($configDataBase, $persistent = false) {
        if (!isset(self::$instance[$configDataBase])) {
            try {
                $config = new Config(CONF_FILE);

                self::$instance[$configDataBase] = new \PDO(
                    $config->getKeyValue("dsn", $configDataBase),
                    $config->getKeyValue("username", $configDataBase),
                    $config->getKeyValue("password", $configDataBase),
                        array(
                            \PDO::ATTR_PERSISTENT => $persistent,
                            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                        )
               );
               self::$instance[$configDataBase]->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }catch(\PDOException $e) {
                echo sprintf("Connection filed: %s", $e->getMessage());
                exit;
            }
        }	
        return self::$instance[$configDataBase];
    }
}