<?php

namespace App\Controllers;

use MF\Controller\Action;

use MF\Model\Container;




class AppController extends Action{

    public function inicio(){

        $this->validaAutenticacao();

        $usuario = Container::getModel('Usuario');
        $usuario->__set('id',$_SESSION['id']);
        $this->view->nome_usuario = $usuario-> getInfoUsuario();

        $somaValor = Container::getModel('Despesa');
        $somaValor->__set('id_usuario', $_SESSION['id']);

        $somaValores = $somaValor->totalValor();

        $this->view->somaValor = $somaValores;

        $somaValorGanho = Container::getModel('Despesa');
        $somaValorGanho->__set('id_usuario', $_SESSION['id']);

        $somaValoresGanhos = $somaValorGanho->totalValorGanhos();

        $this->view->somaValorGanho = $somaValoresGanhos;

        $totalPorCategoria = Container::getModel('Despesa');
        $totalPorCategoria->__set('id_usuario', $_SESSION['id']);

        $totalPorCategorias = $totalPorCategoria->totalDespesaPorCategoria();

        $this->view->totalPorCategoria = $totalPorCategorias;
        

        $this->render('inicio');

    }

    public function validaAutenticacao(){
        session_start();

        if (!isset($_SESSION['id']) || $_SESSION['id'] != '' || !isset($_SESSION['nome']) || $_SESSION['nome'] =! '') {
            return true;
        }else {

            header('Location: /?login=erro1');
        }

    }

    public function cadastroContas(){
        
        $this->validaAutenticacao();

        $this->render('cadastroContas');
        
    }

    public function cadastroGanhos(){
        
        $this->validaAutenticacao();

        $this->render('cadastroGanhos');
        
    }
    public function cadastrarGanhos(){
        
        $this->validaAutenticacao();

        $cadastro = Container::getModel('Despesa');

        $cadastro->__set('id_usuario',$_SESSION['id']);
        $cadastro->__set('ano',$_POST['ano']);
        $cadastro->__set('mes',$_POST['mes']);
        $cadastro->__set('dia',$_POST['dia']);
        $cadastro->__set('naturezaGanho',$_POST['naturezaGanho']);
        $cadastro->__set('descricao',$_POST['descricao']);
        
        
        $cadastro->__set('valor',str_replace(',','.', $_POST['valor']));


 
        $cadastro->cadastrarGanhos();

       header('Location: /cadastroGanhos?status=success');
        
        
    }

    public function consultaContas(){
        $this->validaAutenticacao();

        $despesa = Container::getModel('Despesa');
        $despesa->__set('id_usuario', $_SESSION['id']);

        $despesas = $despesa->getAll();


        $this->view->despesas = $despesas;


        $somaValor = Container::getModel('Despesa');
        $somaValor->__set('id_usuario', $_SESSION['id']);

        $somaValores = $somaValor->totalValor();

        $this->view->somaValor = $somaValores;

        


        $this->render('consultaContas');
    }
    public function consultaGanhos(){
        $this->validaAutenticacao();

        $ganho = Container::getModel('Despesa');
        $ganho->__set('id_usuario', $_SESSION['id']);

        $ganhos = $ganho->getAllGanhos();

        $this->view->ganho = $ganhos;
        //$this->view->id_despesa = $ganhos['id'];


        $somaValor = Container::getModel('Despesa');
        $somaValor->__set('id_usuario', $_SESSION['id']);

        $somaValores = $somaValor->totalValorGanhos();

        $this->view->somaValor = $somaValores;



        $this->render('consultaGanhos');
    }
    public function cadastrarDespesas(){
        $this->validaAutenticacao();

        $cadastro = Container::getModel('Despesa');

        $cadastro->__set('id_usuario',$_SESSION['id']);
        $cadastro->__set('ano',$_POST['ano']);
        $cadastro->__set('mes',$_POST['mes']);
        $cadastro->__set('dia',$_POST['dia']);
        $cadastro->__set('naturezaDespesa',$_POST['naturezaDespesa']);
        $cadastro->__set('descricao',$_POST['descricao']);
        $cadastro->__set('valor',$_POST['valor']);

 
        $cadastro->cadastrarDespesas();

        header('Location: /cadastroContas?status=success');

        
    }

    public function deletarDespesa(){
        $this->validaAutenticacao();
        $remover = isset($_GET['acao']) ? $_GET['acao'] : '';
        
        $id_despesa = $_GET['id_despesa'];

        $remove = Container::getModel('Despesa');
        $remove->__set('id', $_SESSION['id']);

        $remove->deletarDespesa($id_despesa);

       header('Location: /consultaContas');

    }

    public function deletarGanho(){
        $this->validaAutenticacao();
        $remover = isset($_GET['acao']) ? $_GET['acao'] : '';
        
        $id_ganho = $_GET['id_ganho'];

        $remove = Container::getModel('Despesa');
        $remove->__set('id', $_SESSION['id']);

        $remove->deletarGanho($id_ganho);
       header('Location: /consultaGanhos?status=success');


    }


}

?>