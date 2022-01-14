<?php

namespace App\Controllers;

use MF\Controller\Action;

use MF\Model\Container;




class IndexController extends Action{
    

    public function index(){
        $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

        $this->render('index');
       
    }
    public function recursos(){
        

        $this->render('recursos');
       
    }

    public function inscreverse(){
        $this->view->usuario = array(
            'nome' => '',
            'email' => '',
            'celular' => '',
            'senha' => ''

           );

        $this->view->erroCadastro = false;

        $this->render('inscreverse');
    }
// arrumar validacao para cadastro ( esta passando cadastros em branco e sem preenchimento)
    public function registrar(){

        $usuario = Container::getModel('Usuario');
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('celular', $_POST['celular']);
        $usuario->__set('senha', md5($_POST['senha']));
        
        if($usuario->validaUsuario() == true && count($usuario->getUsuarioPorEmail()) == 0) {

            $usuario->inscreverse();
            $this->render('cadastroSucesso');

    } else{
        $this->view->usuario = array(
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'celular' => $_POST['celular'],
        'senha' => $_POST['senha']

        );
        $this->view->erroCadastro = true;
        $this->render('inscreverse');
    }
        
        
    }

    public function login(){
        $this->view->usuario = array(
            'nome' => '',
            'email' => '',
            'celular' => '',
            'senha' => ''

           );

        $this->view->erroCadastro = false;

        $this->render('login');
    }
    

}

?>