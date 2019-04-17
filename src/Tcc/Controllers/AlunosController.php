<?php
namespace Tcc\Controllers;

use Respect\Rest\Routable;
use Tcc\Controllers\AbstractController as AbstractController;
use Tcc\DataAccess\Entity\Alunos as Alunos;


class AlunosController  extends AbstractController implements Routable
{
    public function get() {
        try{
            $DAOFactory = $this->registry->getKey("DAOFactory");
            $alunosDAO = $DAOFactory->createAlunosDAO();
            $alunos = $alunosDAO->filter($_GET['email'], $_GET['senha']);

            return $alunos[0];
        }catch(\Exception $e){
            header("HTTP/1.1 404 Não Encontrado");
            return array( 
                'errorMessage' => $e->getMessage()
            );
        }
    }

    public function post() {
        try{
            $DAOFactory = $this->registry->getKey("DAOFactory");
            $alunosDAO = $DAOFactory->createAlunosDAO();
            $aluno = new Alunos();

            $aluno->setCpf($_REQUEST['cpf'])
            ->setNome($_REQUEST['nome'])
            ->setEndereco($_REQUEST['endereco'])
            ->setUf($_REQUEST['uf'])
            ->setMunicipio($_REQUEST['municipio'])
            ->setTelefone($_REQUEST['telefone'])
            ->setEmail($_REQUEST['email'])
            ->setSenha($_REQUEST['senha']);

            $foundAluno = $alunosDAO->getByCpf($aluno->getCpf());

            if ($foundAluno)
                throw new \InvalidArgumentException("Já existe um cadastro para o CPF informado!");

            $alunosDAO->save($aluno);
            return $aluno;
        }catch(\Exception $e){
            header("HTTP/1.1 400 Requisição Inválida");
            return array( 
                'errorMessage' => $e->getMessage()
            );
        }
    }
}