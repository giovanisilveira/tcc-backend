<?php
namespace Tcc\Controllers;

use Respect\Rest\Routable;
use Tcc\Controllers\AbstractController as AbstractController;
use Tcc\DataAccess\Entity\Alunos as Alunos;


class AutenticarController  extends AbstractController implements Routable
{
    public function get() {
        try{
            $DAOFactory = $this->registry->getKey("DAOFactory");
            $alunosDAO = $DAOFactory->createAlunosDAO();
            $alunos = $alunosDAO->filter($_REQUEST['email'], $_REQUEST['senha']);

            if (empty($alunos))
                throw new \RuntimeException('Aluno não encontrado.');

            return array('user' => $alunos[0], 'token' => 'teste');
        }catch(\Exception $e){
            header("HTTP/1.1 404 Não Encontrado");
            return array( 
                'errorMessage' => $e->getMessage()
            );
        }
    }
}