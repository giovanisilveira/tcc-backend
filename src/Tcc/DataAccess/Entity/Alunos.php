<?php
namespace Tcc\DataAccess\Entity;

class Alunos implements \JsonSerializable
{
    private $cpf;
    private $nome;
    private $endereco;
    private $uf;
    private $municipio;
    private $telefone;
    private $email;
    private $senha;
    private $token;

    /**
     * Get the value of cpf
     */ 
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $cpf = filter_var($cpf, FILTER_SANITIZE_STRING);
        $cpf = preg_replace("/(\.|-)/","",$cpf);

        if (!is_string($cpf))
            throw new \InvalidArgumentException("O CPF deve ser uma string válida.");

        if ((strlen($cpf) < 1) || (strlen($cpf) > 11))
            throw new \InvalidArgumentException("O número de dígitos informados para o CPF é inválido. " . $r);

        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $nome = filter_var($nome, FILTER_SANITIZE_STRING);

        if ((strlen($nome) < 1) || (strlen($nome) > 150))
            throw new \InvalidArgumentException("O número de dígitos informados para o Nome é inválido.");

        $this->nome = trim($nome);

        return $this;
    }

    /**
     * Get the value of endereco
     */ 
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */ 
    public function setEndereco($endereco)
    {
        $endereco = filter_var($endereco, FILTER_SANITIZE_STRING);

        if ((strlen($endereco) < 1) || (strlen($endereco) > 150))
            throw new \InvalidArgumentException("O número de dígitos informados para o Endereço é inválido.");
        
            $this->endereco = trim($endereco);

        return $this;
    }

    /**
     * Get the value of uf
     */ 
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set the value of uf
     *
     * @return  self
     */ 
    public function setUf($uf)
    {
        $uf = filter_var($uf, FILTER_SANITIZE_STRING);

        if ((strlen($uf) < 1) || (strlen($uf) > 2))
            throw new \InvalidArgumentException("O número de dígitos informados para a UF é inválido.");
        
            $this->uf = trim($uf);

        return $this;
    }

    /**
     * Get the value of municipio
     */ 
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     *
     * @return  self
     */ 
    public function setMunicipio($municipio)
    {
        $municipio = filter_var($municipio, FILTER_SANITIZE_STRING);

        if ((strlen($municipio) < 1) || (strlen($municipio) > 100))
            throw new \InvalidArgumentException("O número de dígitos informados para o Município é inválido.");

        $this->municipio = trim($municipio);

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $telefone = filter_var($telefone, FILTER_SANITIZE_STRING);

        if ((strlen($telefone) < 1) || (strlen($telefone) > 15))
            throw new \InvalidArgumentException("O número de dígitos informados para o Telefone é inválido.");

        $this->telefone = trim($telefone);

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            throw new \InvalidArgumentException(sprintf("'%s' é um email inválido.", print_r($email, true)));

        if ((strlen($email) < 1) || (strlen($email) > 200))
            throw new \InvalidArgumentException("O número de dígitos informados para o email é inválido.");


        $this->email = trim($email);

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $senha = filter_var($senha, FILTER_SANITIZE_STRING);

        if (empty($senha))
            throw new \InvalidArgumentException("A senha não pode ser vazia.");

        if ((strlen($senha) < 1) || (strlen($senha) > 40))
            throw new \InvalidArgumentException("O número de dígitos informados para a senha é inválido.");

        $this->senha = trim($senha);

        return $this;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = trim($token);

        return $this;
    }

    public function jsonSerialize() {
        return ['cpf' => $this->cpf,
            'nome'=>$this->nome,
            'endereco'=>$this->endereco,
            'uf'=>$this->uf,
            'municipio'=>$this->municipio,
            'telefone'=>$this->telefone,
            'email'=>$this->email,
            'senha'=>$this->senha,
            'token'=>$this->token
        ];
    }
}