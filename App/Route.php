<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap{
    
    //criação de rotas para ser direcionada aos controllers
    protected function initRoutes(){

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );
        $routes['inscreverse'] = array(
            'route' => '/inscreverse',
            'controller' => 'indexController',
            'action' => 'inscreverse'
        );
        $routes['recursos'] = array(
            'route' => '/recursos',
            'controller' => 'indexController',
            'action' => 'recursos'
        );
        $routes['login'] = array(
            'route' => '/login',
            'controller' => 'indexController',
            'action' => 'login'
        );
        $routes['registrar'] = array(
            'route' => '/registrar',
            'controller' => 'indexController',
            'action' => 'registrar'
        );
        $routes['autenticar'] = array(
            'route' => '/autenticar',
            'controller' => 'AuthController',
            'action' => 'autenticar'
        );
        $routes['inicio'] = array(
            'route' => '/inicio',
            'controller' => 'AppController',
            'action' => 'inicio'
        );
        $routes['sair'] = array(
            'route' => '/sair',
            'controller' => 'AuthController',
            'action' => 'sair'
        );
        $routes['cadastroContas'] = array(
            'route' => '/cadastroContas',
            'controller' => 'AppController',
            'action' => 'cadastroContas'
        );
        $routes['cadastroGanhos'] = array(
            'route' => '/cadastroGanhos',
            'controller' => 'AppController',
            'action' => 'cadastroGanhos'
        );
        $routes['cadastrarDespesas'] = array(
            'route' => '/cadastrarDespesas',
            'controller' => 'AppController',
            'action' => 'cadastrarDespesas'
        );
        $routes['cadastrarGanhos'] = array(
            'route' => '/cadastrarGanhos',
            'controller' => 'AppController',
            'action' => 'cadastrarGanhos'
        );
        $routes['consultaContas'] = array(
            'route' => '/consultaContas',
            'controller' => 'AppController',
            'action' => 'consultaContas'
        );
        $routes['consultaGanhos'] = array(
            'route' => '/consultaGanhos',
            'controller' => 'AppController',
            'action' => 'consultaGanhos'
        );
        $routes['mostrarDespesas'] = array(
            'route' => '/mostrarDespesas',
            'controller' => 'AppController',
            'action' => 'mostrarDespesas'
        );
        $routes['deletarDespesa'] = array(
            'route' => '/deletarDespesa',
            'controller' => 'AppController',
            'action' => 'deletarDespesa'
        );
        $routes['deletarGanho'] = array(
            'route' => '/deletarGanho',
            'controller' => 'AppController',
            'action' => 'deletarGanho'
        );
        

        //com base no mapeamento das rotas setar o atribute routes do objeto Route com base nas rotas captadas pelo init routes
        $this->setRoutes($routes);
    }
}

?>