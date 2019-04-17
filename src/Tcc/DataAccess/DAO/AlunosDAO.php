<?php
namespace Tcc\DataAccess\DAO;

use Tcc\DataAccess\DAO\GenericDAO as GenericDAO;
use Tcc\DataAccess\Entity\Alunos as Alunos;

class AlunosDAO extends GenericDAO
{
    public function filter($email, $senha) {
        $aluno = new Alunos();
        $aluno->setEmail($email)
        ->setSenha(sha1($senha.HASH_SENHA));

        $stm = $this->pdo->prepare('
            select * from alunos
            where (email = :email) and (senha = :senha)
        ');
        $stm->bindValue(':email', $aluno->getEmail(), \PDO::PARAM_STR);
        $stm->bindValue(':senha', $aluno->getSenha(), \PDO::PARAM_STR);
        $stm->setFetchMode(\PDO::FETCH_CLASS, 'Tcc\DataAccess\Entity\Alunos');
        if ($stm->execute()) {
            $alunos = $stm->fetchAll();
            $stm->closeCursor();
        }

        return $alunos;
    }

    public function getByCpf($cpf) {
        $stm = $this->pdo->prepare('
            select * from alunos
            where (cpf = :cpf)
        ');
        $stm->bindValue(':cpf', $cpf, \PDO::PARAM_STR);
        $stm->setFetchMode(\PDO::FETCH_CLASS, 'Tcc\DataAccess\Entity\Alunos');
        if ($stm->execute()) {
            $aluno = $stm->fetch();
            $stm->closeCursor();
        }

        return $aluno;
    }

    public function save(Alunos $aluno) {
        $foundAluno = $this->getByCpf($aluno->getCpf());

        if (!$foundAluno) {
            return $this->insert($aluno);
        }

        return $this->update($aluno);
    }

    public function insert(Alunos $aluno) {
        $stm = $this->pdo->prepare('
            insert into alunos
                set
                cpf             = :cpf,
                nome            = :nome,
                endereco        = :endereco,
                uf              = :uf,
                municipio       = :municipio,
                telefone        = :telefone,
                email           = :email,
                senha           = :senha,
                token           = :token

        ');
        $stm->bindValue(':cpf', $aluno->getCpf(), \PDO::PARAM_STR);
        $stm->bindValue(':nome', $aluno->getNome(), \PDO::PARAM_STR);
        $stm->bindValue(':endereco', $aluno->getEndereco(), \PDO::PARAM_STR);
        $stm->bindValue(':uf', $aluno->getUf(), \PDO::PARAM_STR);
        $stm->bindValue(':municipio', $aluno->getMunicipio(), \PDO::PARAM_STR);
        $stm->bindValue(':telefone', $aluno->getTelefone(), \PDO::PARAM_STR);
        $stm->bindValue(':email', $aluno->getEmail(), \PDO::PARAM_STR);
        $stm->bindValue(':senha', sha1($aluno->getSenha() . HASH_SENHA), \PDO::PARAM_STR);
        $stm->bindValue(':token', $aluno->getToken(), \PDO::PARAM_STR);

        if (!$stm->execute()) {
            throw new \RuntimeException("Não foi possível cadastrar o aluno.");
        }else{
            $aluno = $this->pdo->lastInsertId();
        }

        return $aluno;
    }

    public function update(Alunos $aluno) {
        $stm = $this->pdo->prepare('
            update clientes
                set
                nome            = :nome,
                endereco        = :endereco,
                uf              = :uf,
                municipio       = :municipio,
                telefone        = :telefone,
                email           = :email,
                senha           = :senha,
                token           = :token
            where
                (cpf = :cpf)
        ');
        $stm->bindValue(':cpf', $aluno->getCpf(), \PDO::PARAM_STR);
        $stm->bindValue(':nome', $aluno->getNome(), \PDO::PARAM_STR);
        $stm->bindValue(':endereco', $aluno->getEndereco(), \PDO::PARAM_STR);
        $stm->bindValue(':uf', $aluno->getUf(), \PDO::PARAM_STR);
        $stm->bindValue(':municipio', $aluno->getMunicipio(), \PDO::PARAM_STR);
        $stm->bindValue(':telefone', $aluno->getTelefone(), \PDO::PARAM_STR);
        $stm->bindValue(':email', $aluno->getEmail(), \PDO::PARAM_STR);
        $stm->bindValue(':senha', $aluno->getSenha(), \PDO::PARAM_STR);
        $stm->bindValue(':token', $aluno->getToken(), \PDO::PARAM_STR);

        if (!$stm->execute()) {
            throw new \RuntimeException("Não foi possível alterar os dados do  aluno.");
        }

        return $aluno;
    }

    public function delete(Alunos $aluno) {
        $stm = $this->pdo->prepare('
            delete from alunos where cpf = :cpf
        ');
        $stm->bindValue(':cpf', $aluno->getCpf(), \PDO::PARAM_STR);

        return $stm->execute();
    }   
}