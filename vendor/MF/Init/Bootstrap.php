<?php

namespace MF\Init;

abstract class Bootstrap {

    private $routes;

    abstract protected function initRoutes();

    public function __construct(){
        //ao instanciar o objeto Route disparar o mapeamento das rotas pelo método initRoutes
        $this->initRoutes();
        //inicializado para pegar a url assim que instanciado
        $this->run($this->getUrl());
    }

    public function getRoutes(){
        return $this->routes;
    }

    public function setRoutes(array $routes){
        $this->routes = $routes ;
    }

    
    //método utilizado para fazer o pivô da rotas
    protected function run($url){
        //echo $url;

        foreach ($this->getRoutes() as $key => $route) {

            if($url == $route['route']){
                //instanciando dinamicamente a classe de indexController na pasta Controllers/IndexController.php
                $class = "App\\Controllers\\" . ucfirst($route['controller']);
                //inicializando a classe acima criada
                $controller = new $class;
                //capturando do array route, adquirito no initRoute na instancia do construtor, a acao a ser tomada, ou seja o direcionamento da pagina
                $action = $route['action'];
                //executando o metodo da classe InitRoutes do arquivo do diretorio controller dinamicamente atraves da variavel "$action" junto com a instancia do método "()"
                $controller->$action();
            }
        }

    }

    //pegar o parametro encaminhado pela URL
    protected function getUrl(){
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }


}

?>