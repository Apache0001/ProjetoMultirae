<?php
    namespace MF\Init;

    abstract class Bootstrap{
        protected $routes;

        //Método construtor da classe Route
        public function __construct(){
            $this->initRoutes();
            $this->run($this->getUrl());
        }
        //Método getter
        public function getRoutes(){
            return $this->routes;
        }
        //Método setter
        public function setRoutes(array $routes){
            $this->routes = $routes;
        }
        //Método para gerar dinamicamente  as instancias e os métodos
        protected function run($url){
            foreach($this->getRoutes() as $key => $route){
                
                if ($url == $route['route']){
                    $class = "App\\Controllers\\".$route['controller'];
                    $controller = new $class;
                    $action = $route['action'];
                    $controller->$action();
                }
            }
        }
        // Método que pega a url passada no endereço local.
        protected function getUrl(){
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }

        //Método abstract para classe filha
        abstract protected function initRoutes();
    }
?>