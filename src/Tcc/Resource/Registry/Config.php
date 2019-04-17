<?php
namespace Tcc\Resource\Registry;

/**
 * Classe de acesso a arquivo ini para recuperar parâmetros de configuração
 */

class Config 
{
    /**
     * @var Array Um Array que contem os parametros do arquivo de 
     * configuração em formato ini
     */
    private $parameters = "";

    /**
     * @var string Contem o caminho relativo do arquivo de configuração.
     */
    private $confFile = "";


    /**
     * @param [string] $confFile Caminho relativo do arquivo de configuração
     */
    public function __construct ($confFile) 
    {
        if (!is_string($confFile)) {
            throw new \InvalidArgumentException( sprintf("The '%s' is as invalid string.", $this->confFile) );
        }

        if (!file_exists($confFile)) {
            throw new \InvalidArgumentException( sprintf("The file '%s' does not exists.", $this->confFile) );
        }

        $this->confFile = $confFile;

        $this->parameters = parse_ini_file($this->confFile, true);
    }

    /**
     * Recupera o valor de um dos parâmetros do arquivo de cofniguração
     * 
     * @param  string $key   Nome da chave do parâmetro do arquivo ini
     * @param  string $group Nome do grupo em que a chave está, configurações 
     *                       default estarão no grupo settings
     * @return string        Valor do atributo que deseja recuperar
     */
    public function getKeyValue($key, $group = 'settings') {
        if (!isset($this->parameters[$group])) {
            throw new \InvalidArgumentException( sprintf("The group '%s' on config file '%s' does not exists.", $group, $this->confFile) );
        }

        if (isset($this->parameters[$group][$key])) {
            return $this->parameters[$group][$key];
        }else{
            throw new \InvalidArgumentException( sprintf("The value '%s' of the key in group '%s' on config file  '%s' does not exists.", $key, $group, $this->confFile) );
        }
    }
}
